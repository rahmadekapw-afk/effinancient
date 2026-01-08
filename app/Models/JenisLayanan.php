<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
     protected $table = 'jenis_layanans';

     protected $primaryKey = 'id'; 
    protected $fillable = [
        'jenis_layanan',
        'link',
        'isi',
        'gambar'
    ];
}
