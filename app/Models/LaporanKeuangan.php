<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    public $table = 'laporan_keuangans';
    public $primaryKey = 'laporan_id';
    public $fillable = [
        'admin_id',
        'periode',
        'format_file',
        'file_path',
        'tanggal_buat',
         'created_at',
        'updated_at'
        
    ];
}
