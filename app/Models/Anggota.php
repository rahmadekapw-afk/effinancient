<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    public $table = 'anggotas';
    public $primaryKey = 'anggota_id';
    public $fillable = [
        'nomor_anggota',
        'status_anggota',
        'saldo',
        'simpanan_hari_raya',
        'simpanan_wajib',
        'simpanan_pokok',
        'saldo',
        'username',
        'password',
        'nama_lengkap',
        'email',
        'no_hp',
        'alamat',
        'created_at',
        'updated_at'
    ];
}
