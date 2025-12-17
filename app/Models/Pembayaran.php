<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public $table = 'pembayarans';
    public $primaryKey = 'pembayaran_id';
    public $fillable = [
        'anggota_id',
        'simpanan_id',
        'pinjaman_id',
        'metode',
        'nominal',
        'tanggal_bayar',
                'status',
                'midtrans_order_id',
                'midtrans_transaction_id',
                'midtrans_status',
                'midtrans_response',
                'created_at',
                'updated_at'
    ];
}
