<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori',
        'judul',
        'slug',
        'external_url',
        'gambar',
        'isi',
        'tanggal',
        'views',
        'status',
    ];
}
