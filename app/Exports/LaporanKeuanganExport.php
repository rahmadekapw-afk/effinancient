<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanKeuanganExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function collection() {
        return $this->data;
    }

    public function headings(): array {
        return ["Tanggal", "Keterangan", "Pemasukan", "Pengeluaran"];
    }

    public function map($row): array {
        return [
            $row['tanggal']->format('d/m/Y'),
            $row['keterangan'],
            $row['masuk'],
            $row['keluar'],
        ];
    }
}
