<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Notifikasi;
use App\Models\Tren_rupiah;
use App\Models\Pembayaran;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

        $data['notifikasi'] = Notifikasi::leftJoin('anggotas', 'notifikasis.anggota_id', '=', 'anggotas.anggota_id')
        ->select(
            'notifikasis.*',
            'anggotas.username'
        )
        ->orderBy('notifikasis.created_at', 'desc')
        ->get();

        // data tren rupiah

        $query = Tren_rupiah::query();

        if ($request->bulan && $request->tahun) {
            $query->whereRaw("SUBSTRING(date,4,2) = ?", [$request->bulan])
                ->whereRaw("SUBSTRING(date,7,2) = ?", [$request->tahun]);
        }

        $rows = $query->select(
                DB::raw("SUBSTRING(date,4,2) as bulan"),
                DB::raw("SUBSTRING(date,7,2) as tahun"),
                DB::raw("AVG(high)  as high"),
                DB::raw("AVG(close) as close"),
                DB::raw("AVG(open)  as open"),
                DB::raw("AVG(low)   as low")
            )
            ->groupBy('bulan','tahun')
            ->orderByRaw("CAST(tahun AS UNSIGNED), CAST(bulan AS UNSIGNED)")
            ->get();

                    $data['labels']    = [];
                    $data['highData']  = [];
                    $data['closeData'] = [];
                    $data['openData']  = [];
                    $data['lowData']   = [];

                    foreach ($rows as $r) {
                        $data['labels'][]    = $r->bulan.'/20'.$r->tahun;
                        $data['highData'][]  = round($r->high);
                        $data['closeData'][] = round($r->close);
                        $data['openData'][]  = round($r->open);
                        $data['lowData'][]   = round($r->low);
                    }

                // algoritma c4.5
                $terbaru = Tren_rupiah::orderByRaw(
                    "STR_TO_DATE(`Date`, '%d/%m/%y') DESC"
                )->first();

                $rataRataTerbaru = (
                    (float) $terbaru->Close +
                    (float) $terbaru->High +
                    (float) $terbaru->Low +
                    (float) $terbaru->Open
                ) / 4;

                $totalClose = Tren_rupiah::sum('Close');
                $totalHigh  = Tren_rupiah::sum('High');
                $totalLow   = Tren_rupiah::sum('Low');
                $totalOpen  = Tren_rupiah::sum('Open');
                $jumlahData = Tren_rupiah::count();

                $keseluruhan_rata = 0;
                if ($jumlahData > 0) {
                    $totalSemuaKolom = $totalClose + $totalHigh + $totalLow + $totalOpen;
                    $keseluruhan_rata = $totalSemuaKolom / ($jumlahData * 4);
                }

                $trenrupiah = ($rataRataTerbaru + $keseluruhan_rata) / 2;

/* =========================================================
| 1. DATA TRAINING
=========================================================*/
$dataTraining = [
 ['tren'=>'rendah','simpanan'=>'besar','kali'=>'sering','bayar'=>'besar','kelas'=>'tinggi'],
 ['tren'=>'sedang','simpanan'=>'sedang','kali'=>'jarang','bayar'=>'sedang','kelas'=>'menengah'],
 ['tren'=>'tinggi','simpanan'=>'kecil','kali'=>'jarang','bayar'=>'kecil','kelas'=>'rendah'],
 ['tren'=>'sedang','simpanan'=>'besar','kali'=>'sering','bayar'=>'besar','kelas'=>'tinggi'],
 ['tren'=>'rendah','simpanan'=>'kecil','kali'=>'jarang','bayar'=>'kecil','kelas'=>'rendah'],
];

/* =========================================================
| 2. FUNGSI MATEMATIS C4.5
=========================================================*/
function entropy($data){
 $t=count($data); $k=array_count_values(array_column($data,'kelas')); $e=0;
 foreach($k as $c){$p=$c/$t; $e-=$p*log($p,2);} return $e;
}
function informationGain($d,$a){
 $t=count($d); $e0=entropy($d);
 foreach($d as $r)$s[$r[$a]][]=$r;
 $ea=0; foreach($s as $x)$ea+=(count($x)/$t)*entropy($x);
 return $e0-$ea;
}
function splitInfo($d,$a){
 $t=count($d); $n=array_count_values(array_column($d,$a)); $s=0;
 foreach($n as $c){$p=$c/$t; $s-=$p*log($p,2);} return $s;
}
function gainRatio($d,$a){
 $si=splitInfo($d,$a); return $si==0?0:informationGain($d,$a)/$si;
}
function majorityClass($d){
 $k=array_count_values(array_column($d,'kelas')); arsort($k); return array_key_first($k);
}

/* =========================================================
| 3. HITUNG ENTROPY, GAIN, ROOT
=========================================================*/
$atribut=['tren','simpanan','kali','bayar'];
$entropyKelas = entropy($dataTraining);
foreach($atribut as $a){
 $informationGain[$a]=informationGain($dataTraining,$a);
 $gainRatio[$a]=gainRatio($dataTraining,$a);
}
arsort($gainRatio);
$root = array_key_first($gainRatio);

/* =========================================================
| 4. BANGUN POHON
=========================================================*/
function buildTree($data,$attrs){
 $kls=array_unique(array_column($data,'kelas'));
 if(count($kls)==1) return $kls[0];
 if(count($attrs)==0) return majorityClass($data);
 foreach($attrs as $a)$g[$a]=gainRatio($data,$a);
 arsort($g); $best=array_key_first($g);
 foreach(array_unique(array_column($data,$best)) as $v){
   $sub=array_filter($data,fn($d)=>$d[$best]==$v);
   $tree['atribut']=$best;
   $tree['cabang'][$v]=count($sub)?buildTree($sub,array_diff($attrs,[$best])):majorityClass($data);
 }
 return $tree;
}
$tree = buildTree($dataTraining,$atribut);

/* =========================================================
| 5. KLASIFIKASI & OUTPUT
=========================================================*/
function classify($tree,$data){
 if(!is_array($tree)) return $tree;
 $a=$tree['atribut']; return $tree['cabang'][$data[$a]] ?? majorityClass([]);
}

$hasil=[];
foreach(Anggota::all() as $a){

 $simpanan_sehat = $a->saldo;
 $pinjaman_berapa_kali = Pinjaman::where('anggota_id',$a->anggota_id)->count();
 $total_pembayaran_pinjaman = Pembayaran::where('anggota_id',$a->anggota_id)
        ->where('status','berhasil')->sum('nominal');

 $uji=[
   'tren'=>$trenrupiah>=14000?'tinggi':($trenrupiah>=13500?'sedang':'rendah'),
   'simpanan'=>$simpanan_sehat>=70000000?'besar':($simpanan_sehat>=30000000?'sedang':'kecil'),
   'kali'=>$pinjaman_berapa_kali>=4?'sering':'jarang',
   'bayar'=>$total_pembayaran_pinjaman>=80000000?'besar':($total_pembayaran_pinjaman>=30000000?'sedang':'kecil')
 ];

 $kelas = classify($tree,$uji);

 $batas = match($kelas){
   'tinggi'=>150000000,
   'menengah'=>75000000,
   default=>30000000
 };

 $hasil[]=[
   'nama'=>$a->username,
   'tren_rupiah'=>$trenrupiah,
   'simpanan'=>$simpanan_sehat,
   'pembayaran'=>$total_pembayaran_pinjaman,
   'kali'=>$pinjaman_berapa_kali,
   'entropy_kelas'=>round($entropyKelas,4),
   'information_gain'=>round($informationGain[$root],4),
   'gain_ratio'=>round($gainRatio[$root],4),
   'batas_pinjaman'=>$batas
 ];
}



        // visualisasi diagram pie
                $data['kategori150'] = 0;
                $data['kategori75']  = 0;
                $data['kategori30']  = 0;

                foreach ($hasil as $h) {
                    if ($h['batas_pinjaman'] == 150000000) {
                        $data['kategori150']++;
                    } elseif ($h['batas_pinjaman'] == 75000000) {
                        $data['kategori75']++;
                    } else {
                        $data['kategori30']++;
                    }
                }
            

                // =====================
                // TOTAL ANGGOTA LAYAK
                // =====================
                $data['total_anggota_layak'] =
                $data['kategori150']
                + $data['kategori75']
                + $data['kategori30'];

                // =====================
                // DATA HASIL (TABEL)
                // =====================
                $data['hasil'] = $hasil;
        
        //data tren batang
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;
                $data['total_pinjaman'] = Pinjaman::whereMonth('created_at', $bulanIni)
                    ->whereYear('created_at', $tahunIni)
                    ->sum('nominal');

                // Pembayaran bulan ini
                $data['total_pembayaran'] = Pembayaran::whereMonth('created_at', $bulanIni)
                    ->whereYear('created_at', $tahunIni)
                    ->sum('nominal');
                
            
                /* ===============================
                SIMPANAN ANGGOTA (AKUMULATIF)
                ================================ */
                $data['simpanan_pokok'] = Anggota::sum('simpanan_pokok');
                $data['simpanan_wajib'] = Anggota::sum('simpanan_wajib');
                $data['simpanan_hari_raya'] = Anggota::sum('simpanan_hari_raya');

                $data['transactionChartData'] = [
                    (int) $data['simpanan_pokok'],
                    (int) $data['simpanan_wajib'],
                    (int) $data['simpanan_hari_raya'],
                    (int) $data['total_pembayaran'],
                    (int) $data['total_pinjaman'],
                ];


                // visualisasi pinjaman

            $distribusi = Pinjaman::select(DB::raw("
                CASE
                    WHEN nominal < 5000000 THEN '0-5jt'
                    WHEN nominal BETWEEN 5000000 AND 9999999 THEN '5-10jt'
                    WHEN nominal BETWEEN 10000000 AND 19999999 THEN '10-20jt'
                    WHEN nominal BETWEEN 20000000 AND 49999999 THEN '20-50jt'
                    ELSE '50jt+'
                END AS rentang,
                COUNT(*) as total
            "))
            ->groupBy('rentang')
            ->orderByRaw("
                CASE rentang
                    WHEN '0-5jt' THEN 1
                    WHEN '5-10jt' THEN 2
                    WHEN '10-20jt' THEN 3
                    WHEN '20-50jt' THEN 4
                    ELSE 5
                END
            ")
            ->get();

        $data['loan_dist_labels'] = $distribusi->pluck('rentang');
        $data['loan_dist_values'] = $distribusi->pluck('total');


        // diagram pembayaran
            $payments = Pembayaran::selectRaw('DATE(created_at) as tanggal, SUM(nominal) as total')
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->limit(31)
                ->get();

            $data['payment_labels'] = $payments->pluck('tanggal');
            $data['payment_values'] = $payments->pluck('total');



        return view('admin.admin',$data, [
            'hasil' => $hasil,
            'entropyKelas' => $entropyKelas,
            'informationGain' => $informationGain,
            'gainRatio' => $gainRatio,
            'root' => $root ,
            
        ]);
    }

    public function filterPayments($month)
        {
            $payments = Pembayaran::selectRaw('DATE(created_at) as tanggal, SUM(nominal) as total')
                ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$month])
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            return response()->json([
                'labels' => $payments->pluck('tanggal'),
                'values' => $payments->pluck('total')
            ]);
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
                'username_admin' => $admin->username,
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
        // Hanya hapus session admin, session anggota tetap aman
        session()->forget('admin_id'); 
        return redirect('/login')->with('pesan_sukses', 'Berhasil logout Admin');
    }
}
    


