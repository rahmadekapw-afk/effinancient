<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pinjaman;
use App\Models\Pembayaran;

$pinjamen = Pinjaman::select('pinjaman_id','anggota_id','nominal','status_pinjaman','created_at')
    ->orderBy('created_at','desc')->take(50)->get()->toArray();

$pembayarans = Pembayaran::select('pembayaran_id','pinjaman_id','anggota_id','status','midtrans_order_id','nominal','created_at')
    ->orderBy('created_at','desc')->take(100)->get()->toArray();

echo json_encode(['pinjamen'=>$pinjamen,'pembayarans'=>$pembayarans], JSON_PRETTY_PRINT);
