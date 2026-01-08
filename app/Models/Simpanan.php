<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    public $table = 'simpanans';
    public $primaryKey = 'simpanan_id';
    public $fillable = [
        'anggota_id',
        'jenis_simpanan',
        'nominal',
        'tanggal_setor',
        'saldo',
        'status',
    ];
}
