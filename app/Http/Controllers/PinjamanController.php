<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Anggota;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function hitungLimitPinjaman($anggotaId)
     {
    //     // Ambil total simpanan anggota
    //     $totalSimpanan = Anggota::where('anggota_id', $anggotaId)->sum('saldo');

    //     // Algoritma limit (contoh: 30% dari total simpanan)
    //     $limit = $totalSimpanan * 0.3;

    //     return $limit;
    }

    // Simpan pengajuan pinjaman
   

    public function store(Request $request)
{
    $jangka = $request->jangka_waktu; // bulan
    $nominal = $request->nominal;
    $persen_bunga = 0.7; // 0.7% per bulan

    // 1. Bunga per bulan
    $bunga_per_bulan = ($nominal * $persen_bunga) / 100;

    // 2. Pokok per bulan
    $pokok_per_bulan = $nominal / $jangka;

    // 3. Angsuran per bulan
    $angsuran_per_bulan = $pokok_per_bulan + $bunga_per_bulan;

    // 4. Total pinjaman + bunga
    $total_nominal = $nominal + ($bunga_per_bulan * $jangka);

    // Simpan ke database
    $p = Pinjaman::create([
        'anggota_id'          => $request->anggota_id,
        'nominal'             => $total_nominal,
        'tenor'               => $jangka,
        'bunga'               => $persen_bunga,
        'status_pinjaman'     => 'menunggu',
        'tanggal_pengajuan'   => $request->tanggal_pengajuan,
        'angsuran_per_bulan'  => $angsuran_per_bulan,
        'jumlah_dibayar'      => 0,
        'jangka_waktu'        => $jangka
    ]);

    // Notifikasi admin
    try {
        \App\Models\Notifikasi::create([
            'admin_id' => null,
            'anggota_id' => null,
            'judul' => 'Pengajuan Pinjaman',
            'isi' => 'Pinjaman #' . $p->pinjaman_id .
                     ' oleh anggota ' . $p->anggota_id .
                     ' mengajukan nominal Rp ' . number_format($p->nominal, 0, ',', '.'),
            'tanggal' => now(),
            'is_admin_read' => false,
        ]);
    } catch (\Exception $e) {
      \Illuminate\Support\Facades\Log::warning('Create pengajuan notifikasi failed: ' . $e->getMessage());
    }

    return back()->with('pesan_sukses', 'Pengajuan pinjaman berhasil dikirim!');
}
}
    

