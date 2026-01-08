<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Berita;
use App\Models\JenisLayanan;
use App\Models\LaporanKeuangan;

class UserController extends Controller
{
    
    
    public function welcome(){

        $data['artikels'] = Berita::orderBy('created_at', 'desc')->take(3)->get();
        $data['jenis_layanan'] = JenisLayanan::get();

        $data['jumlah_anggota'] = $jumlah_anggota = Anggota::count();
        $data['simpanan'] = $saldo = Anggota::sum('saldo');
        $data['anggota_aktif'] = Anggota::where('status_anggota','aktif')->count();
        $data['anggota_nonaktif'] = Anggota::where('status_anggota','nonaktif')->count();
       

        return view('welcome', $data);
    }

    
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
        // Hanya hapus session anggota, session admin tetap aman
        session()->forget('anggota_id');
        return redirect('/login')->with('pesan_sukses', 'Berhasil logout Anggota');
    }
    
}

