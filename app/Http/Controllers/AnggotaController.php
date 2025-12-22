<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $data['saldo'] = Anggota::where('anggota_id', session('anggota_id'))->value('saldo');
        // Ambil pinjaman yang masih memiliki sisa pembayaran (jumlah_dibayar < nominal)
        // ini lebih tahan terhadap kondisi di mana status_pinjaman mungkin belum sinkron
    $data['pinjaman'] = Pinjaman::where('anggota_id', session('anggota_id'))
            ->where('status_pinjaman', 'disetujui') // filter status disetujui
            ->whereRaw('COALESCE(jumlah_dibayar, 0) < nominal') // belum lunas
            ->get();

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
            return view('anggota.anggota',$data);
        }


    
    public function profile()
    {
        $id = session('anggota_id');   // ambil ID anggota yg login

    // Ambil data anggota berdasarkan ID
       $anggota = Anggota::find($id);

        return view('anggota.profile', compact('anggota'));


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
    public function update(Request $request)
    {
        $anggota = Anggota::where('anggota_id', session('anggota_id'))->first();

        $anggota->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
        ]);

        return redirect()->back()->with('pesan_sukses', 'Profil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
    }

    }

