<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $table = 'admins';
    public $primaryKey = 'admin_id';
    public $fillable = [
        'username',
        'password',
        'nama_admin'
    ];
}
