<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    public $table = 'pinjamen';
    public $primaryKey = 'pinjaman_id';
    public $fillable = [
        'anggota_id',
        'nominal',
        'tenor',
        'bunga',
        'status_pinjaman',
        'tanggal_pengajuan',
        'pembayaran',
        'jangka_waktu',
         'created_at',
        'updated_at'
    ];
}
