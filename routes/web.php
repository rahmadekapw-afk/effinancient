<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SuperAdminController,
    AdminController,
    RoleController,
    AnggotaController,
    SimpananController,
    PinjamanController,
    PembayaranController,
    NotifikasiController,
    WaGatewayController,
    LaporanKeuanganController,
    BeritaController,
    UserController
};
use App\Models\LaporanKeuangan;

Route::get('/', function() {
    $artikels = \App\Models\Berita::orderBy('created_at', 'desc')->take(3)->get();
    return view('welcome', ['artikels' => $artikels]);
});


// Super Admin
Route::get('/login', [UserController::class, 'index']);
Route::get('/login_anggota', [UserController::class, 'masuk']);
Route::post('/admin/manajemen_admin/tambah', [SuperAdminController::class, 'store']);
Route::delete('/admin/manajemen_akses/hapus/{id}', [SuperAdminController::class, 'hapus_admin']);

Route::get('dashboard/anggota', [AnggotaController::class, 'index'])->middleware('anggota_auth');
Route::get('anggota/logout', [UserController::class, 'logout'])->middleware('anggota_auth');
Route::get('/anggota/profile', [AnggotaController::class, 'profile'])->middleware('anggota_auth');
Route::post('/anggota/profile/kritik', [NotifikasiController::class, 'store']);
Route::get('/anggota/simpanan', [SimpananController::class, 'index'])->middleware('anggota_auth');
Route::get('/anggota/transaksi', [SimpananController::class, 'transaksi'])->middleware('anggota_auth');
Route::post('/anggota/setor', [PembayaranController::class, 'setor'])->middleware('anggota_auth');
Route::put('/anggota/profile/update', [AnggotaController::class, 'update'])->middleware('anggota_auth');



Route::get('/login_admin', [AdminController::class, 'masuk']);
Route::get('dashboard/admin', [AdminController::class, 'index'])->middleware('admin.or.super');
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('admin.or.super');

Route::post(
    'admin/manajemen_anggota/import_excel',
    [SuperAdminController::class, 'importExcel']
)->name('anggota.import.excel');


Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
Route::get('/tren-rupiah/create', [AdminController::class,'tren_rupiah'])->name('tren_rupiah.create');

Route::get('/admin/manajemen_anggota',[SuperAdminController::class,'manajemen_anggota'])->middleware('admin.or.super');
Route::delete('/admin/manajemen_anggota/hapus/{id}',[SuperAdminController::class,'hapus_anggota'])->middleware('admin.or.super');
Route::post('/admin/manajemen_anggota/tambah',[SuperAdminController::class,'tambah_anggota'])->middleware('admin.or.super');
// Tambah simpanan (admin) — menambahkan nilai ke kolom simpanan yang sesuai
Route::post('/admin/simpanan/tambah/{jenis}/{id}', [SuperAdminController::class, 'tambahSimpanan'])->middleware('admin.or.super');

Route::get('/admin/manajemen_akses',[SuperAdminController::class,'manajemen_akses'])->middleware('superadmin.auth');

Route::get('/admin/transaksi',[AdminController::class,'transaksi'])->middleware('admin.or.super');
// AJAX endpoint: jumlah pinjaman menunggu untuk lonceng notifikasi (admin)
Route::get('/admin/pinjaman/notifications', [AdminController::class, 'pinjamanNotifications'])->middleware('admin.or.super');
// Admin view: daftar notifikasi pengajuan pinjaman
Route::get('/admin/notifikasi/pengajuan', [AdminController::class, 'pengajuanNotificationsView'])->middleware('admin.or.super');
Route::get('/admin/transaksi/konfirmasi/{pinjaman_id}', [AdminController::class, 'konfirmasi'])
    ->name('admin.transaksi.konfirmasi')->middleware('admin.or.super');
    Route::post('/admin/pinjaman/{id}/lunas', [AdminController::class, 'lunas'])
    ->name('pinjaman.lunas')->middleware('admin.or.super');

    
Route::get('/admin/laporan_keuangan',[LaporanKeuanganController::class,'index'])->middleware('admin.or.super');


Route::get('/admin/artikel',[AdminController::class,'artikel'])->middleware('admin.or.super');
Route::get('/admin/artikel/{id}/edit', [AdminController::class, 'editArtikel'])->middleware('admin.or.super');
Route::put('/admin/artikel/{id}', [AdminController::class, 'updateArtikel'])->middleware('admin.or.super');
Route::delete('/admin/artikel/{id}', [AdminController::class, 'hapusArtikel'])->middleware('admin.or.super');
Route::post('/admin/artikel/{id}/copy', [AdminController::class, 'copyArtikel'])->middleware('admin.or.super');
Route::get('/admin/berita_layanan',[AdminController::class,'berita_layanan'])->middleware('admin.or.super');



// Route::resource('anggota', AnggotaController::class);


Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
Route::get('/superadmin/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.create');
Route::put('/admin/manajemen_anggota/update/{id}', [SuperAdminController::class, 'update'])->name('superadmin.create');
Route::post('/superadmin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.store');
Route::delete('/superadmin/{admin}', [SuperAdminController::class, 'destroy'])->name('superadmin.destroy');


// superadmin

Route::get('/admin/audit_trail',[SuperAdminController::class, 'audit'])->name('superadmin.index');





// Admin dan Role
// Route::resource('admin', AdminController::class);
Route::resource('role', RoleController::class);

// Anggota


// Simpanan
Route::resource('simpanan', SimpananController::class);

// // Pinjaman
// Route::resource('pinjaman', PinjamanController::class);
Route::post('dashboard/anggota/pinjaman/store', [PinjamanController::class, 'store']);


// Pembayaran
Route::resource('pembayaran', PembayaranController::class);

// Quick pay: langsung inisiasi Midtrans untuk pinjaman anggota
// Alias route: arahkan ke pinjaman pertama anggota jika user membuka URL tanpa id
Route::get('dashboard/anggota/pinjaman/bayar', function () {
    $anggotaId = session('anggota_id');
    $pinjaman = \App\Models\Pinjaman::where('anggota_id', $anggotaId)->first();
    if (! $pinjaman) {
        return redirect()->back()->withErrors('Tidak ada pinjaman ditemukan');
    }
    return redirect("dashboard/anggota/pinjaman/bayar-now/{$pinjaman->pinjaman_id}");
})->middleware('anggota_auth');

// Quick pay: langsung inisiasi Midtrans untuk pinjaman anggota
Route::get('dashboard/anggota/pinjaman/bayar-now/{pinjaman}', [PembayaranController::class, 'bayarNow'])->middleware('anggota_auth');
// Bayar angsuran via redirect (full-page) — per angsuran
Route::get('dashboard/anggota/pinjaman/bayar-now-angsuran/{pinjaman}/{angsuran}/{nominal}', [PembayaranController::class, 'bayarNowAngsuran'])->middleware('anggota_auth');

// Midtrans notification (server-to-server)
Route::post('midtrans/notification', [PembayaranController::class, 'midtransNotification']);
// Midtrans return (user redirected back after payment)
Route::get('midtrans/return', [PembayaranController::class, 'midtransReturn']);
// Midtrans bayar angsuran (AJAX)
Route::post('midtrans/bayar-angsuran', [PembayaranController::class, 'bayarAngsuran'])->middleware('anggota_auth');
// Midtrans: cek status pinjaman (dipanggil dari frontend setelah pembayaran)
Route::get('midtrans/pinjaman-status/{pinjaman}', [PembayaranController::class, 'pinjamanStatus'])->middleware('anggota_auth');

// Pembayaran

// Notifikasi
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi', [NotifikasiController::class, 'store'])->name('notifikasi.store');
// Endpoint untuk lonceng anggota: kembalikan jumlah notifikasi pinjaman untuk anggota yang login
Route::get('/anggota/notifications', [NotifikasiController::class, 'anggotaNotifications']);
Route::post('/notifikasi/mark-read', [NotifikasiController::class, 'markRead']);
Route::post('/notifikasi/delete', [NotifikasiController::class, 'delete']);

// WA gateway: send a Stored Notifikasi to anggota via Fonnte
Route::post('/wa/send-notifikasi/{notifikasi}', [WaGatewayController::class, 'sendNotifikasi']);

// Test endpoint (stateless) to send arbitrary phone+message to WA gateway without DB/session
Route::post('/wa/test-send', [WaGatewayController::class, 'testSend'])->middleware('api');
// Allow GET for quick testing from browser/PowerShell without CSRF token
Route::get('/wa/test-send', [WaGatewayController::class, 'testSend']);
// Test endpoint: gunakan nomor dari tabel anggota atau notifikasi
Route::post('/wa/test-send-member', [WaGatewayController::class, 'testSendMember'])->middleware('api');
Route::get('/wa/test-send-member', [WaGatewayController::class, 'testSendMember']);



// Quick multipart test for Fonnte (mirrors curl multipart example)
Route::get('/wa/test-send-multipart', function () {
    $service = app(\App\Services\FonnteService::class);

    $fields = [
        'target' => '08123456789|Fonnte|Admin,08123456789|Lili|User',
        'message' => 'test message to {name} as {var1}',
        'url' => 'https://md.fonnte.com/images/wa-logo.png',
        'filename' => 'filename',
        'schedule' => 0,
        'typing' => false,
        'delay' => '2',
        'countryCode' => '62',
        'location' => '-7.983908, 112.621391',
        'followup' => 0,
    ];

    try {
        $res = $service->sendMultipart($fields);
        return response()->json(['success' => true, 'response' => $res]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
});

// Multipart test sending to anggota from DB (optional anggota id)
Route::get('/wa/test-send-multipart-member/{anggota?}', function ($anggota = 1) {
    $service = app(\App\Services\FonnteService::class);
    $anggotaModel = \App\Models\Anggota::find($anggota);
    if (! $anggotaModel) {
        return response()->json(['success' => false, 'error' => 'Anggota not found: ' . $anggota], 404);
    }
    // choose notifikasi: prefer query param notifikasi_id, else latest for anggota
    $req = request();
    $notifikasiId = $req->query('notifikasi_id');
    $notif = null;
    if ($notifikasiId) {
        $notif = \App\Models\Notifikasi::where('notifikasi_id', $notifikasiId)->first();
    }
    if (! $notif) {
        $notif = \App\Models\Notifikasi::where('anggota_id', $anggota)->latest('created_at')->first();
    }

    if (! $notif) {
        return response()->json(['success' => false, 'error' => 'Notifikasi tidak ditemukan untuk anggota ini'], 404);
    }

    // normalize phone: keep digits, replace leading 0 with 62
    $raw = preg_replace('/[^0-9]/', '', $anggotaModel->no_hp ?? '');
    if (substr($raw, 0, 1) === '0') {
        $raw = '62' . substr($raw, 1);
    }

    $fields = [
        'target' => $raw,
        'message' => trim(($notif->judul ?? '') . "\n\n" . ($notif->isi ?? '')),
        'countryCode' => '62',
    ];

    try {
        $res = $service->sendMultipart($fields);
        return response()->json(['success' => true, 'response' => $res]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
});

// TEMP: create a Notifikasi record for anggota and trigger store-send flow
Route::get('/wa/test-create-notifikasi/{anggota?}', function ($anggota = 1) {
    $anggotaModel = \App\Models\Anggota::find($anggota);
    if (! $anggotaModel) {
        return response()->json(['success' => false, 'error' => 'Anggota not found']);
    }

    $judul = 'Ping otomatis';
    $isi = 'Ini pesan otomatis setelah penyimpanan notifikasi pada ' . now();

    $notifikasi = \App\Models\Notifikasi::create([
        'anggota_id' => $anggotaModel->anggota_id,
        'judul' => $judul,
        'isi' => $isi,
        'tanggal' => now(),
    ]);

    // trigger the same sending logic as store() by calling the controller logic
    try {
        $service = app(\App\Services\FonnteService::class);
        $normalized = preg_replace('/[^0-9]/', '', $anggotaModel->no_hp ?? '');
        if (substr($normalized, 0, 1) === '0') {
            $normalized = '62' . substr($normalized, 1);
        }
        $fields = [
            'target' => $normalized,
            'message' => trim($notifikasi->judul . "\n\n" . $notifikasi->isi),
            'countryCode' => '62',
        ];
        $resp = $service->sendMultipart($fields);
        return response()->json(['success' => true, 'notifikasi' => $notifikasi, 'response' => $resp]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
});

// Laporan Keuangan
Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->name('laporan.index');

// Berita: daftar, buat, simpan
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
 
// Admin: simpan artikel dari halaman admin/artikel
Route::post('/admin/artikel/simpan', [AdminController::class, 'simpanArtikel'])->middleware('admin.or.super');
// Admin: simpan jenis layanan dari halaman admin/artikel
Route::post('/admin/jenis_layanan/simpan', [AdminController::class, 'simpanJenisLayanan'])->middleware('admin.or.super');


// laporan unduh pdf dan excel

Route::get('/export-excel', [LaporanKeuanganController::class, 'exportExcel'])->name('laporan.excel');
Route::get('/export-pdf', [LaporanKeuanganController::class, 'exportPdf'])->name('laporan.pdf');

// filter pembayaran
Route::get('/dashboard/payments/{month}', [AdminController::class, 'filterPayments']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);
