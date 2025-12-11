<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pinjaman;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data['jumlah_anggota'] = Anggota::count();
        $data['simpanan'] = Anggota::sum('saldo');
        $data['anggota_aktif'] = Anggota::where('status_anggota','aktif')->count();
        $data['anggota_nonaktif'] = Anggota::where('status_anggota','nonaktif')->count();
        $data['anggota_nonaktif'] = Anggota::where('status_anggota','nonaktif')->count();

        return view('admin.admin');
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

    public function konfirmasi($idAnggota){
         $status = request('status'); // diterima / ditolak

        Pinjaman::where('anggota_id', $idAnggota)->update([
            'status_pinjaman' => $status
        ]);

        return back()->with('pesan_sukses', 'Status berhasil diperbarui!');
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
}
