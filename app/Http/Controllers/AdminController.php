<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Pembayaran;
use App\Models\SuperAdmin;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Notifikasi;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data['jumlah_anggota'] = $jumlah_anggota = Anggota::count();
        $data['simpanan'] = $saldo = Anggota::sum('saldo');
        $data['anggota_aktif'] = Anggota::where('status_anggota','aktif')->count();
        $data['anggota_nonaktif'] = Anggota::where('status_anggota','nonaktif')->count();
        $data['anggota_nonaktif'] = Anggota::where('status_anggota','nonaktif')->count();

        $simpanan = Simpanan::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

        $pinjaman = Pinjaman::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();

        $data['pertumbuhan'] = $pertumbuhan = $simpanan + $pinjaman ;
        $data ['presentase'] = ($pertumbuhan / $jumlah_anggota ) * 100;

        $data['total_transaksi'] = Pembayaran::count();

        return view('admin.admin',$data);
    }

    public function transaksi()
    {
       $data ['pinjaman'] = Pinjaman::join('anggotas', 'pinjamen.anggota_id', '=', 'anggotas.anggota_id')
        ->select('pinjamen.*', 'anggotas.*')
        ->get();


        $data['total_pinjaman_menunggu'] = Pinjaman::where('status_pinjaman', 'menunggu')
                                        ->sum('nominal');

        $data['transaksi_sekarang'] = Pinjaman::whereDate('tanggal_pengajuan', Carbon::today())->count();
        
        $data['pending'] = Pinjaman::where('status_pinjaman', 'menunggu')->count();

        $data ['total_pinjaman_terima'] = Pinjaman::where('status_pinjaman', 'disetujui', Carbon::today())                           
        ->count();
        return view('admin.transaksi',$data);
    }

    /**
     * Return JSON count of pinjaman yang perlu perhatian (status "menunggu").
     * Dipanggil oleh frontend untuk menyalakan/buramkan lonceng notifikasi.
     */
    public function pinjamanNotifications()
    {
        // Hitung notifikasi yang relevan untuk admin: Pinjaman Disetujui atau Pinjaman Lunas
            // Hitung notifikasi pengajuan pinjaman yang belum dibaca oleh admin
            $query = \App\Models\Notifikasi::where('judul', 'like', '%Pengajuan Pinjaman%')
                    ->where('is_admin_read', false);

            $count = $query->count();

            $latest = $query->orderByDesc('created_at')
                    ->limit(5)
                    ->get(['notifikasi_id', 'judul', 'isi', 'tanggal', 'created_at']);

            return response()->json(['count' => $count, 'latest' => $latest]);
    }

    /**
     * Tampilkan halaman admin yang berisi daftar notifikasi pengajuan pinjaman (admin-only)
     */
    public function pengajuanNotificationsView()
    {
        $req = request();

        // default: hanya tampilkan yang belum dibaca oleh admin
        $showAll = $req->query('show') === 'all';

        $query = \App\Models\Notifikasi::where('judul', 'like', '%Pengajuan Pinjaman%');
        if (! $showAll) {
            $query = $query->where('is_admin_read', false);
        }

        $query = $query->orderByDesc('created_at');

        $notifikasis = $query->paginate(20)->appends(['show' => $showAll ? 'all' : 'unread']);

        return view('admin.pengajuan_notifikasi', compact('notifikasis', 'showAll'));
    }

    public function konfirmasi($pinjaman_id){
         $status = request('status'); // diterima / ditolak

        Pinjaman::where('pinjaman_id', $pinjaman_id)->update([
            'status_pinjaman' => $status
        ]);

        // Jika status disetujui, buat entri Notifikasi (gunakan kolom yang ada)
        if ($status === 'disetujui') {
            $p = Pinjaman::where('pinjaman_id', $pinjaman_id)->first();
            if ($p) {
                Notifikasi::create([
                    'admin_id' => session('admin_id') ?? null,
                    'anggota_id' => $p->anggota_id,
                    'judul' => 'Pinjaman Disetujui',
                    'isi' => 'Pinjaman #' . $p->pinjaman_id . ' untuk anggota ' . $p->anggota_id . ' telah disetujui.',
                    'tanggal' => now(),
                ]);
                // Hapus notifikasi pengajuan yang terkait dengan pinjaman ini
                try {
                    \App\Models\Notifikasi::where('judul', 'like', '%Pengajuan Pinjaman%')
                        ->where('isi', 'like', '%Pinjaman #'. $p->pinjaman_id .'%')
                        ->delete();
                } catch (\Exception $e) {
                    // log jika gagal, tapi jangan ganggu alur
                    \Illuminate\Support\Facades\Log::warning('Failed to delete pengajuan notifikasi: '.$e->getMessage());
                }
            }
        }

        return back()->with('pesan_sukses', 'Status berhasil diperbarui!');
    }

    public function lunas($id)
{
    $pinjaman = Pinjaman::where('pinjaman_id', $id)->firstOrFail();

    // keamanan: hanya boleh lunas jika sudah disetujui
    if ($pinjaman->status_pinjaman !== 'disetujui') {
        return response()->json([
            'success' => false,
            'message' => 'Pinjaman belum disetujui'
        ], 400);
    }

    $pinjaman->update([
        'status_pinjaman' => 'lunas'
    ]);

    // Buat notifikasi untuk admin bahwa pinjaman telah dilunasi
    Notifikasi::create([
        'admin_id' => session('admin_id') ?? null,
        'anggota_id' => $pinjaman->anggota_id,
        'judul' => 'Pinjaman Lunas',
        'isi' => 'Pinjaman #' . $pinjaman->pinjaman_id . ' telah dilunasi oleh anggota ' . $pinjaman->anggota_id . '.',
        'tanggal' => now(),
    ]);

    return response()->json([
        'success' => true
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
   public function masuk(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $passwordHash = sha1($request->password);

        // 1. Cek Admin
        $admin = Admin::where('username', $request->username)
            ->where('password', $passwordHash)
            ->first();

        if ($admin) {
            session([
                'admin_id' => $admin->admin_id,
                'username' => $admin->username,
                'nama'     => $admin->nama_admin,
                'login'    => true,
            ]);

            return redirect('/dashboard/admin');
        }

        // 2. Cek SuperAdmin
        $superadmin = Superadmin::where('username', $request->username)
            ->where('password', $passwordHash)
            ->first();

        if ($superadmin) {
            session([
                'superadmin_id' => $superadmin->superadmin_id,
                'username'      => $superadmin->username,
                'nama'          => $superadmin->nama_superadmin,
                'login'         => true,
            ]);

            return redirect('/dashboard/admin');
        }

        return back()->with('pesan_error', 'Username atau password salah');
    }


    

    public function logout(){
        session()->flush();
        return redirect('/login')->with('pesan_sukses', 'Berhasil logout');
    }
}
    


