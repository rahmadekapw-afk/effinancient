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


Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/anggota/profile', [AnggotaController::class, 'profile']);

Route::get('/anggota/simpanan', [SimpananController::class, 'index']);

Route::get('/anggota/transaksi', [SimpananController::class, 'transaksi']);



Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/manajemen_anggota',[SuperAdminController::class,'manajemen_anggota']);
Route::delete('/admin/manajemen_anggota/hapus/{id}',[SuperAdminController::class,'hapus_anggota']);
Route::post('/admin/manajemen_anggota/tambah',[SuperAdminController::class,'tambah_anggota']);

Route::get('/admin/manajemen_akses',[SuperAdminController::class,'manajemen_akses']);

Route::get('/admin/transaksi',[AdminController::class,'transaksi']);
Route::get('/admin/transaksi/konfirmasi/{idAnggota}', [AdminController::class, 'konfirmasi'])
    ->name('admin.transaksi.konfirmasi');
    
Route::get('/admin/laporan_keuangan',[LaporanKeuanganController::class,'index']);



Route::resource('anggota', AnggotaController::class);


Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
Route::get('/superadmin/create', [SuperAdminController::class, 'createAdmin'])->name('superadmin.create');
Route::put('/admin/manajemen_anggota/update/{id}', [SuperAdminController::class, 'update'])->name('superadmin.create');
Route::post('/superadmin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.store');
Route::delete('/superadmin/{admin}', [SuperAdminController::class, 'destroy'])->name('superadmin.destroy');


// Admin dan Role
Route::resource('admin', AdminController::class);
Route::resource('role', RoleController::class);

// Anggota


// Simpanan
Route::resource('simpanan', SimpananController::class);

// Pinjaman
Route::resource('pinjaman', PinjamanController::class);

// Pembayaran
Route::resource('pembayaran', PembayaranController::class);

// Notifikasi
Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::post('/notifikasi', [NotifikasiController::class, 'store'])->name('notifikasi.store');

// Laporan Keuangan
Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->name('laporan.index');
