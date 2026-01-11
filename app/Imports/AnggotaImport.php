<?php

namespace App\Imports;

use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class AnggotaImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        // 🚨 WAJIB: SKIP BARIS KOSONG / RUSAK
        if (
            empty($row['nomor_anggota']) ||
            trim($row['nomor_anggota']) === ''
        ) {
            return null;
        }

        return new Anggota([
            'nomor_anggota'        => trim($row['nomor_anggota']),
            'status_anggota'       => $row['status_anggota'] ?? 'aktif',
            'saldo'                => $row['saldo'] ?? 0,
            'simpanan_hari_raya'   => $row['simpanan_hari_raya'] ?? 0,
            'simpanan_wajib'       => $row['simpanan_wajib'] ?? 0,
            'simpanan_pokok'       => $row['simpanan_pokok'] ?? 0,
            'username'             => $row['username'] ?? ('user_' . uniqid()),
            'password'             => Hash::make($row['password'] ?? '123456'),
            'nama_lengkap'         => $row['nama_lengkap'] ?? '-',
            'email'                => $row['email'] ?? null,
            'no_hp'                => $row['no_hp'] ?? null,
            'alamat'               => $row['alamat'] ?? null,
        ]);
    }
}
