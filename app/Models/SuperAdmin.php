<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    public $table = 'super_admins';
    public $primaryKey = 'superadmin_id';
    public $fillable = [
        'username',
        'password',
        'nama_superadmin',
        'level_akses'
    ];
}
