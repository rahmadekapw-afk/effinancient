<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Admin;
use App\Models\Anggota; // ADDED
use Illuminate\Support\Facades\DB; // ADDED
class NotifikasiController extends Controller
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

    
        //
    

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
    public function store(Request $request)
    {
        // ambil anggota dari session atau input (fallback)
        $anggotaId = session('anggota_id') ?? $request->input('anggota_id');
        $anggota = Anggota::where('anggota_id', $anggotaId)->first();
        if (! $anggota) {
            return redirect()->back()->withErrors('Anggota tidak ditemukan. Tidak dapat mengirim notifikasi.');
        }

        // ambil judul/isi (dukung field 'kritik' juga)
        $judul = $request->input('judul') ?? 'Kritik Saran';
        $isi   = $request->input('isi') ?? $request->input('kritik') ?? '';

        // simpan di tabel notifikasis
        Notifikasi::create([
            'anggota_id' => $anggota->anggota_id,
            'judul'      => $judul,
            'isi'        => $isi,
            'tanggal'    => now(),
        ]);

        // siapkan pesan untuk WA gateway — ambil nomor hp dari anggota (coba beberapa nama kolom)
        $phone = $anggota->no_hp ?? $anggota->phone ?? $anggota->telepon ?? null;
        if ($phone) {
            // masukkan ke tabel naratif (gateway queue). Sesuaikan nama tabel/kolom jika berbeda.
            DB::table('naratif')->insert([
                'to'         => $phone,
                'title'      => $judul,
                'message'    => $isi,
                'status'     => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('pesan_sukses', 'Notifikasi berhasil dikirim!');
    }
}

