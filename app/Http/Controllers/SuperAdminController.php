<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    public function tambah_anggota(Request $request)
    {
        // 2. Insert data
        Anggota::create([
            'nomor_anggota'  => $request->nomor_anggota,
            'username'       => $request->username,
            'password'       => hash('sha256', $request->password),
            'nama_lengkap'   => $request->nama_lengkap,
            'email'          => $request->email ?? null,
            'no_hp'          => $request->no_hp ?? null,
            'saldo'          => $request->saldo ?? 0,
            'status_anggota' => $request->status_anggota,
            'alamat'         => $request->alamat ?? null,
        ]);

        // 3. Redirect sukses
        return redirect()->back()->with('pesan_sukses', 'Anggota berhasil ditambahkan.');
    }
        
    
    public function manajemen_anggota()
    {   
        $dataanggota = Anggota::all();
        $data['total_anggota'] = Anggota::count();
        $data['anggota_aktif'] = Anggota::where('status_anggota','aktif')->count();
        $data['anggota_nonaktif'] = Anggota::where('status_anggota','nonaktif')->count();
        $data['anggota'] = $dataanggota;
        
        
        return view('admin.manajemen_anggota',$data);


    }

    public function hapus_anggota($id){
        Anggota::where('anggota_id',$id)
        ->delete();
        return redirect('admin/manajemen_anggota')->with('pesan_sukses','anggota berhasil dihapus');
    }

    public function manajemen_akses()
    {
         $admins = Admin::all();

       
        return view('admin.manajemen_akses', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
         // Validasi input
        $request->validate([
            'nomor_anggota'   => 'required|string|max:50',
            'nama_lengkap'    => 'required|string|max:100',
            'email'           => 'required|email|max:100',
            'no_hp'           => 'required|string|max:20',
            'saldo'           => 'required|numeric|min:0',
            'status_anggota'  => 'required|in:aktif,nonaktif',
        ]);

      

        // Ambil data anggota
        $anggota = Anggota::findOrFail($id);

        // Update data
        $anggota->update([
            'nomor_anggota'  => $request->nomor_anggota,
            'nama_lengkap'   => $request->nama_lengkap,
            'email'          => $request->email,
            'no_hp'          => $request->no_hp,
            'saldo'          => $request->saldo,
            'status_anggota' => $request->status_anggota,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
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
        
        // Simpan ke database
        Admin::create([
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'nama_admin' => $request->nama_admin,
        ]);

        
         return redirect('admin/manajemen_akses')->with('pesan_sukses','anggota berhasil dihapus');
    }
    public function hapus_admin($id)
    {
    Admin::where('admin_id', $id)->delete();

    return redirect('admin/manajemen_akses')
        ->with('pesan_sukses', 'Admin berhasil dihapus');
    }

}

