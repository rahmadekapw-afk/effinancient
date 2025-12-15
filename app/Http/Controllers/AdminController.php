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

    public function konfirmasi($pinjaman_id){
         $status = request('status'); // diterima / ditolak

        Pinjaman::where('pinjaman_id', $pinjaman_id)->update([
            'status_pinjaman' => $status
        ]);

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
    


