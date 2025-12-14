<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    public $table = 'notifikasis';
    public $primaryKey = 'notifikasi_id';
    public $fillable = [
        'admin_id',
        'anggota_id',
        'judul',
        'isi',
        'tanggal',
         'created_at',
        'updated_at'
    ];
}
