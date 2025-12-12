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
    LaporanKeuanganController,
    UserController
};
use App\Models\LaporanKeuangan;

Route::get('/', function() {
    return view('welcome');
});


// Super Admin
Route::get('/login', [UserController::class, 'index']);
Route::get('/login_anggota', [UserController::class, 'masuk']);
Route::post('/admin/manajemen_admin/tambah', [SuperAdminController::class, 'store']);
Route::delete('/admin/manajemen_akses/hapus/{id}', [SuperAdminController::class, 'hapus_admin']);

Route::get('dashboard/anggota', [AnggotaController::class, 'index'])->middleware('anggota_auth');
Route::get('anggota/logout', [UserController::class, 'logout'])->middleware('anggota_auth');
Route::get('/anggota/profile', [AnggotaController::class, 'profile'])->middleware('anggota_auth');

Route::get('/anggota/simpanan', [SimpananController::class, 'index'])->middleware('anggota_auth');

Route::get('/anggota/transaksi', [SimpananController::class, 'transaksi'])->middleware('anggota_auth');



Route::get('/login_admin', [AdminController::class, 'masuk']);
Route::get('dashboard/admin', [AdminController::class, 'index'])->middleware('admin_auth');
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('admin_auth');

Route::get('/admin/manajemen_anggota',[SuperAdminController::class,'manajemen_anggota'])->middleware('admin_auth');
Route::delete('/admin/manajemen_anggota/hapus/{id}',[SuperAdminController::class,'hapus_anggota'])->middleware('admin_auth');
Route::post('/admin/manajemen_anggota/tambah',[SuperAdminController::class,'tambah_anggota'])->middleware('admin_auth');

Route::get('/admin/manajemen_akses',[SuperAdminController::class,'manajemen_akses'])->middleware('admin_auth');

Route::get('/admin/transaksi',[AdminController::class,'transaksi'])->middleware('admin_auth');
Route::get('/admin/transaksi/konfirmasi/{idAnggota}', [AdminController::class, 'konfirmasi'])
    ->name('admin.transaksi.konfirmasi')->middleware('admin_auth');
    
Route::get('/admin/laporan_keuangan',[LaporanKeuanganController::class,'index'])->middleware('admin_auth');



Route::resource('anggota', AnggotaController::class);


Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
Route::get('/superadmin/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.create');
Route::put('/admin/manajemen_anggota/update/{id}', [SuperAdminController::class, 'update'])->name('superadmin.create');
Route::post('/superadmin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.store');
Route::delete('/superadmin/{admin}', [SuperAdminController::class, 'destroy'])->name('superadmin.destroy');


// Admin dan Role
// Route::resource('admin', AdminController::class);
Route::resource('role', RoleController::class);

// Anggota


// Simpanan
Route::resource('simpanan', SimpananController::class);

// Pinjaman
Route::resource('pinjaman', PinjamanController::class);
Route::post('dashboard/anggota/pinjaman/store', [PinjamanController::class, 'store']);


// Pembayaran
Route::resource('pembayaran', PembayaranController::class);

// Notifikasi
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi', [NotifikasiController::class, 'store'])->name('notifikasi.store');

// Laporan Keuangan
Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->name('laporan.index');
