<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembekuanBulanan extends Model
{
    public $table = 'pembekuan_bulanans';
    public $primaryKey = 'pembekuan_id';
    public $fillable = [
        'bulan',
        'status',
        'tanggal_proses',
         'created_at',
        'updated_at'
    ];
}
