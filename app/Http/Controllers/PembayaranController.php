<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class PembayaranController extends Controller
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
  
    public function setor(Request $request)
    {

        // JIKA SETOR SIMPANAN
        if ($request->jenis === 'simpanan') {

            Simpanan::create([
                'nominal'       => $request->nominal,
                'tanggal_setor' => Carbon::now(),
                'saldo'         => $request->nominal,
                'anggota_id'    => session('anggota_id'),

            ]);

        } 
 
else {

    $anggotaId = session('anggota_id');
    if (!$anggotaId) {
        return back()->withErrors('Session anggota tidak ditemukan');
    }

    $anggota = Anggota::findOrFail($anggotaId);

    DB::transaction(function () use ($request, $anggota) {

        // =========================
        // JIKA METODE SALDO
        // =========================
        if ($request->metode === 'saldo') {

            // cek saldo cukup
            if ($anggota->saldo < $request->nominal) {
                throw new \Exception('Saldo tidak mencukupi');
            }

            // kurangi saldo
            $anggota->decrement('saldo', $request->nominal);
        }

        // =========================
        // SIMPAN PEMBAYARAN
        // =========================
        Pembayaran::create([
            'jenis'         => $request->jenis, // qurban, zakat, wajib
            'metode'        => $request->metode,
            'nominal'       => $request->nominal,
            'anggota_id'    => session('anggota_id'),
            'tanggal_bayar' => Carbon::now(),
            'status'        => 'berhasil',
        ]);

        // =========================
        // KIRIM NOTIFIKASI WA
        // =========================
        if ($anggota->no_hp) {

            $pesan = "Assalamu’alaikum {$anggota->nama},

Pembayaran {$request->jenis} berhasil ✅

Nominal : Rp " . number_format($request->nominal, 0, ',', '.') . "
Metode  : {$request->metode}
Tanggal : " . Carbon::now()->format('d-m-Y') . "

Terima kasih 🙏";

            Http::post(config('services.whatsapp.url'), [
                'phone'   => $anggota->no_hp,
                'message' => $pesan,
            ]);
        }
    });

}


     


        return redirect()->back()->with('pesan_sukses', 'Transaksi berhasil disimpan');
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
}
