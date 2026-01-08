<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AnggotaImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 
use App\Models\Admin;
use App\Models\Anggota;
use App\Models\LaporanKeuangan;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\PembekuanBulanan;
use App\Models\Pinjaman;
use App\Models\Simpanan;

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
    public function audit()
    {   
           $auditTrail = collect();

        $models = [
            'Admin'             => Admin::class,
            'Anggota'           => Anggota::class,
            'Laporan Keuangan'  => LaporanKeuangan::class,
            'Notifikasi'        => Notifikasi::class,
            'Pembayaran'        => Pembayaran::class,
            'Pembekuan Bulanan' => PembekuanBulanan::class,
            'Pinjaman'          => Pinjaman::class,
            'Simpanan'          => Simpanan::class,
        ];

        foreach ($models as $label => $modelClass) {

            $rows = $modelClass::select(
                $modelClass::query()->getModel()->getKeyName(),
                'created_at',
                'updated_at'
            )->get();

            foreach ($rows as $row) {

                $primaryKey = $row->getKeyName();
                $id = $row->{$primaryKey};

                if ($row->created_at) {
                    $auditTrail->push([
                        'model' => $label,
                        'id'    => $id,
                        'aksi'  => 'created',
                        'waktu' => $row->created_at,
                    ]);
                }

                if ($row->updated_at && $row->updated_at != $row->created_at) {
                    $auditTrail->push([
                        'model' => $label,
                        'id'    => $id,
                        'aksi'  => 'updated',
                        'waktu' => $row->updated_at,
                    ]);
                }
            }
        }

        return view('admin.audit_trail', [
            'auditTrail' => $auditTrail->sortByDesc('waktu')->values()
        ]);

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
            'simpanan_wajib'          => $request->wajib ?? 0,
            'simpanan_pokok'          => $request->pokok ?? 0,
            'simpanan_hari_raya'          => $request->hari_raya ?? 0,
            'status_anggota' => $request->status_anggota,
            'alamat'         => $request->alamat ?? null,
        ]);

        // Tidak membuat notifikasi pada saat create — notifikasi hanya akan dibuat ketika data anggota diupdate

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

      public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new AnggotaImport, $request->file('excel_file'));

        return redirect()
            ->back()
            ->with('success', 'Data anggota berhasil diimpor');
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

        // Buat notifikasi hanya ketika update anggota (sesuai permintaan)
        try {
            Notifikasi::create([
                'admin_id' => session('admin_id') ?? null,
                'anggota_id' => $anggota->anggota_id,
                'judul' => 'Anggota Diperbarui',
                'isi' => 'Data anggota ' . ($anggota->nama_lengkap ?? $anggota->username) . ' telah diperbarui.',
                'tanggal' => now(),
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('Create update anggota notifikasi failed: ' . $e->getMessage());
        }

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Tambah simpanan untuk anggota (admin action)
     * jenis: qurban | wajib | sehat | pokok
     */
    public function tambahSimpanan(Request $request, $jenis, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ]);

        $jumlah = (float) $request->input('jumlah');

        $anggota = Anggota::findOrFail($id);

        // Map jenis ke kolom pada tabel anggotas
        $map = [
            'qurban' => 'simpanan_hari_raya',
            'wajib'  => 'simpanan_wajib',
            'sehat'  => 'saldo',
            'pokok'  => 'simpanan_pokok',
        ];

        if (! isset($map[$jenis])) {
            return redirect()->back()->withErrors('Jenis simpanan tidak dikenal');
        }

        $kolom = $map[$jenis];

        // Tambahkan nilai (increment)
        $nilaiBaru = ($anggota->{$kolom} ?? 0) + $jumlah;
        $anggota->update([$kolom => $nilaiBaru]);

            // Buat notifikasi untuk anggota
            try {
                $notif = Notifikasi::create([
                    'admin_id' => session('admin_id') ?? null,
                    'anggota_id' => $anggota->anggota_id,
                    'judul' => 'Penambahan Simpanan',
                    'isi' => 'Penambahan ' . ucfirst($jenis) . ' sebesar Rp ' . number_format($jumlah, 0, ',', '.') . ' telah ditambahkan ke akun Anda.',
                    'tanggal' => now(),
                ]);

                // Kirim via WA gateway langsung juga (panggilan ke service)
                try {
                    $phone = $anggota->no_hp ?? null;
                    if ($phone) {
                        $normalized = preg_replace('/[^0-9]/', '', $phone);
                        if (substr($normalized, 0, 1) === '0') {
                            $normalized = '62' . substr($normalized, 1);
                        }

                        $message = trim(($notif->judul ?? '') . "\n\n" . ($notif->isi ?? ''));
                        $service = app(\App\Services\FonnteService::class);
                        $fields = [
                            'target' => $normalized,
                            'message' => $message,
                            'countryCode' => '62',
                        ];
                        $resp = $service->sendMultipart($fields);
                        \Illuminate\Support\Facades\Log::info('WA send from tambahSimpanan', ['to' => $normalized, 'response' => $resp]);
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('WA send from tambahSimpanan failed: ' . $e->getMessage());
                }

            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('Create simpanan notifikasi failed: ' . $e->getMessage());
            }

        return redirect()->back()->with('pesan_sukses', 'Simpanan berhasil ditambahkan.');
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

