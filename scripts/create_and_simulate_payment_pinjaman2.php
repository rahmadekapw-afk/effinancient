<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pembayaran;
use Illuminate\Support\Facades\Artisan;

// Pastikan pinjaman_id 2 ada
$pinjamanId = 2;
$anggotaId = 1;
$nominal = 300000;

// Buat pembayaran pending
$p = Pembayaran::create([
    'anggota_id' => $anggotaId,
    'pinjaman_id' => $pinjamanId,
    'metode' => 'midtrans',
    'nominal' => $nominal,
    'tanggal_bayar' => now(),
    'status' => 'pending',
]);

echo "Created pembayaran_id: " . $p->pembayaran_id . PHP_EOL;

// Pastikan ada midtrans_order_id (karena normally dibuat oleh bayarNow)
$orderId = 'pembayaran-' . $p->pembayaran_id . '-' . time();
$p->update(['midtrans_order_id' => $orderId]);

// Jalankan artisan simulate untuk pembayaran ini
Artisan::call('midtrans:simulate', ['--pembayaran_id' => $p->pembayaran_id]);

echo Artisan::output();
