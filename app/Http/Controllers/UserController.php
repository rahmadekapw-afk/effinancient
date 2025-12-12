<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class UserController extends Controller
{
    public function index(){
        
        return view('login');
    }

   public function masuk(Request $request){
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Hash SHA1
        $passwordHash = sha1($request->password);

        // Cek pada Model Anggota
        $anggota = Anggota::where('username', $request->username)
            ->where('password', $passwordHash)
            ->first();
            if ($anggota) {
                
                // Simpan session login
                session([
                    'anggota_id' => $anggota->anggota_id,
                    'username'   => $anggota->username,
                    'nama'       => $anggota->nama_lengkap,
                    
                    'login'      => true,
                ]);
        
            return redirect('dashboard/anggota')->with('pesan_sukses', 'Berhasil login');
        }

        return back()->with('pesan_error', 'Username atau password salah');
    }

    public function logout(){
        session()->flush();
        return redirect('/login')->with('pesan_sukses', 'Berhasil logout');
    }
    
}

