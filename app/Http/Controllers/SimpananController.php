<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
    $data ['total_nominal'] = Pinjaman::where('anggota_id', session('anggota_id'))
            ->where('status_pinjaman', 'disetujui')
            ->sum('nominal');

    
    $data['sisa_pinjaman'] = Pinjaman::where('anggota_id', session('anggota_id'))
            ->where('status_pinjaman', 'disetujui')
            ->sum(DB::raw('nominal - angsuran_per_bulan * jumlah_dibayar'));

    $anggota = Anggota::where('anggota_id', session('anggota_id'))->first();

    $data['saldo'] = $anggota ? $anggota->saldo : 0;
    $data['hari_raya'] = $anggota ? $anggota->simpanan_hari_raya : 0;
    $data['pokok'] = $anggota ? $anggota->simpanan_pokok : 0;
    $data['wajib'] = $anggota ? $anggota->simpanan_wajib : 0;

    $data['total_saldo'] = $data['saldo'] + $data['hari_raya'] + $data['pokok'] +  $data['wajib'] ;
    $data['progres_pinjaman'] = 0;

        if ($data['total_nominal'] > 0) {
            $terbayar = $data['total_nominal'] - $data['sisa_pinjaman'];

            $data['progres_pinjaman'] = round(
                ($terbayar / $data['total_nominal']) * 100,
                2
            );
        }
    $data['info'] = Notifikasi::where('anggota_id', session('anggota_id'))
    ->where('judul', '!=', 'kritik saran')
    ->orderBy('tanggal', 'desc')
    ->get();

    $data['angsuran'] = Pembayaran::query()
    ->join('pinjamen', 'pembayarans.pinjaman_id', '=', 'pinjamen.pinjaman_id')
    ->where('pembayarans.anggota_id', session('anggota_id'))
    ->where('pembayarans.status', 'berhasil')
    ->orderBy('pembayarans.created_at', 'asc')
    ->select(
        DB::raw("DATE_FORMAT(pembayarans.created_at, '%b %Y') as bulan"),
        'pinjamen.angsuran_per_bulan'
    )
    ->get();

    /*
    |--------------------------------------------------------------------------
    | Data untuk Chart
    |--------------------------------------------------------------------------
    */
    $data['chart_labels'] = $data['angsuran']->pluck('bulan');
    $data['chart_values'] = $data['angsuran']->pluck('angsuran_per_bulan');

  

        return view('anggota.simpanan',$data);
    }
    public function transaksi()
    {
       
    $anggotaId = session('anggota_id');
     

    $data['totalPemasukan'] = Pinjaman::where('anggota_id', $anggotaId)
    ->where('status_pinjaman', 'disetujui')
    ->sum(DB::raw('nominal + (angsuran_per_bulan * jumlah_dibayar)'));

    /* =========================
     | 2. TOTAL PENGELUARAN
     |  - semua pembayaran anggota
     ========================= */
    $data['totalPengeluaran'] = Pembayaran::where('anggota_id', $anggotaId)
        ->where('status', 'berhasil')
        ->sum('nominal');

    /* =========================
     | 3. TOTAL TRANSAKSI
     |  - pinjaman + pembayaran
     ========================= */
    $totalPinjaman = Pinjaman::where('anggota_id', $anggotaId)
    ->count();

    $totalPembayaran = Pembayaran::where('anggota_id', $anggotaId)
    ->where('status', 'berhasil')
    ->count();

    $data['totalTransaksi'] = $totalPinjaman + $totalPembayaran;

    $pembayaran = Pembayaran::where('anggota_id', $anggotaId)
        ->where('status', 'berhasil')
        ->get()
        ->map(function ($item) {
            return [
                'tanggal' => $item->created_at,
                'jenis'   => 'Pembayaran',
                'jumlah'  => $item->nominal,
                'metode'  => $item->metode,
                'status'  => $item->status,
            ];
        });

    /* ===============================
    DATA PINJAMAN
    ================================ */
    $pinjaman = Pinjaman::where('anggota_id', $anggotaId)
        ->where('status_pinjaman', 'disetujui')
        ->get()
        ->map(function ($item) {
            return [
                'tanggal' => $item->created_at,
                'jenis'   => 'Pinjaman',
                'jumlah'  => $item->nominal,
                'metode'  => '-',
                'status'  => $item->status_pinjaman,
            ];
        });

    /* ===============================
    GABUNG + SORT
    ================================ */
    $data['transaksi'] = collect()
        ->merge($pembayaran)
        ->merge($pinjaman)
        ->sortByDesc('tanggal')
        ->values();


        return view('anggota.transaksi',$data);
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
        $request->validate([
        'jenis'   => 'required|in:hari_raya,sehat,wajib,pokok,qurban',
        'nominal' => 'required|numeric|min:1000',
    ]);

    $anggota = Anggota::where(
        'anggota_id',
        session('anggota_id')
    )->first();

    if (! $anggota) {
        return back()->withErrors('Anggota tidak ditemukan');
    }

    // =========================
    // SIMPAN SIMPANAN (PENDING)
    // =========================
    DB::table('simpanans')->insert([
        'anggota_id' => $anggota->anggota_id,
        'jenis_simpanan'      => $request->jenis,
        'nominal'    => $request->nominal,
        'tanggal_setor' => Carbon::now(),
        'saldo'      => $request->nominal,
        'status'     => 'pending',
    ]);

    // =========================
    // NOTIFIKASI ADMIN
    // =========================
    $label = [
        'hari_raya' => 'Hari Raya',
        'sehat'     => 'Sehat',
        'wajib'     => 'Wajib',
        'pokok'     => 'Pokok',
        'qurban'    => 'Qurban',
    ];

    $judul = 'Pengajuan Simpanan ' . $label[$request->jenis];

    $isi = 'Anggota ' . $anggota->nama_lengkap .
        ' mengajukan simpanan ' .
        strtolower($label[$request->jenis]) .
        ' senilai Rp ' . number_format($request->nominal, 0, ',', '.') .
        '.';

    $admins = Admin::all();

    foreach ($admins as $admin) {
            Notifikasi::create([
                'admin_id' => null, // untuk semua admin
                'anggota_id' => session('anggota_id'),
                'judul' => 'Pengajuan Simpanan ' . ucfirst($request->jenis_simpanan),
                'isi' => 'Anggota ' . session('username') .
                    ' mengajukan simpanan ' . $request->jenis_simpanan .
                    ' senilai Rp ' . number_format($request->nominal, 0, ',', '.'),
                'is_admin_read' => false,
                'tanggal' => Carbon::now(),
            ]);
    }

    return back()->with('success', 'Pengajuan simpanan berhasil dikirim');
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
}
