<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pinjaman;
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['saldo'] = Anggota::where('anggota_id', session('anggota_id'))->value('saldo');
        $data['pinjaman'] = Pinjaman::where([
            'anggota_id' => session('anggota_id'),
            'status_pinjaman' => 'disetujui'
        ])->get();

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

