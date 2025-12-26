<?php

namespace App\Imports;

use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AnggotaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Anggota([
            'nomor_anggota'        => $row['nomor_anggota'],
            'status_anggota'       => $row['status_anggota'],
            'saldo'                => $row['saldo'] ?? 0,
            'simpanan_hari_raya'   => $row['simpanan_hari_raya'] ?? 0,
            'simpanan_wajib'       => $row['simpanan_wajib'] ?? 0,
            'simpanan_pokok'       => $row['simpanan_pokok'] ?? 0,
            'username'             => $row['username'],
            'password'              => sha1($row['password']),
            'nama_lengkap'         => $row['nama_lengkap'],
            'email'                => $row['email'],
            'no_hp'                => $row['no_hp'],
            'alamat'               => $row['alamat'],
        ]);
    }
}
