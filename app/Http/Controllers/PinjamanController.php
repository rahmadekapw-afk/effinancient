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
       

        // // Hitung limit
        // $limit = $this->hitungLimitPinjaman($request->session('anggota_id'));

        // Jika nominal melebihi limit → Tolak
        // if ($request->nominal > $limit) {
        //     return back()->with('error', 'Nominal melebihi batas maksimal pinjaman: Rp ' . number_format($limit, 0, ',', '.'));
        // }

        // Buat pinjaman baru
       $jangka = $request->jangka_waktu; // misal: 12 (bulan)
$nominal = $request->nominal;      // misal: 10.000.000
$persen_bunga = 0.7;               // asumsi 0.7% per bulan

// 1. Hitung Bunga per bulan
// Rumus: (Total Pinjaman * Persentase Bunga) / 100
$bunga = ($nominal * $persen_bunga) / 100;

// 2. Hitung Cicilan Pokok per bulan
// Rumus: Total Pinjaman / Jangka Waktu
$pokok = $nominal / $jangka;

// 3. Total Angsuran per bulan
$angsuran = $pokok + $bunga;
        $p = Pinjaman::create([
            'anggota_id'        => $request->anggota_id,
            'nominal'           => $request->nominal,
            'tenor'             => 0.7,
            'bunga'             => 0.7, // misal bunga flat
            'status_pinjaman'   => 'menunggu',
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'angsuran_per_bulan' => $angsuran,
            'jumlah_dibayar' => 0,
            'jangka_waktu'     => $request->jangka_waktu
        ]);

        // Buat notifikasi untuk admin bahwa ada pengajuan pinjaman baru (tanpa mengirim WA ke anggota)
        try {
            \App\Models\Notifikasi::create([
                'admin_id' => null,
                'anggota_id' => null,
                'judul' => 'Pengajuan Pinjaman',
                'isi' => 'Pinjaman #' . $p->pinjaman_id . ' oleh anggota ' . $p->anggota_id . ' mengajukan nominal Rp ' . number_format($p->nominal,0,',','.'),
                'tanggal' => now(),
                'is_admin_read' => false,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('Create pengajuan notifikasi failed: ' . $e->getMessage());
        }

        // Tidak membuat notifikasi pada saat create — notifikasi hanya dibuat ketika ada update

        return back()->with('pesan_sukses', 'Pengajuan pinjaman berhasil dikirim!');

        
    }
}

