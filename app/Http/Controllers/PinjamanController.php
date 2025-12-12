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
        Pinjaman::create([
            'anggota_id'        => $request->anggota_id,
            'nominal'           => $request->nominal,
            'tenor'             => 2,
            'bunga'             => 2, // misal bunga flat
            'status_pinjaman'   => 'menunggu',
            'tanggal_pengajuan' => $request->tanggal_pengajuan
        ]);

        return back()->with('pesan_sukses', 'Pengajuan pinjaman berhasil dikirim!');

        
    }
}

