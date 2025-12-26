<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tren_rupiah extends Model
{
    public $table = 'tren_rupiah';
    public $fillable = [
        'Date',
        'Close',
        'High',
        'Low',
         'Open',
        'rata_rata'
    ];
}
