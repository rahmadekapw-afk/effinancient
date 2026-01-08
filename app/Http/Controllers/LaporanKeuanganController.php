<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Notifikasi;
use App\Models\Tren_rupiah;
use App\Models\Pembayaran;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use App\Exports\LaporanKeuanganExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;


class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
       $totalPendapatan = Pinjaman::where('status_pinjaman','disetujui')->select(
            DB::raw('SUM(angsuran_per_bulan * jumlah_dibayar) as total')
        )->value('total');

        $data['pemasukan'] = $totalPendapatan;

        $totalPengeluaran = Pinjaman::where('status_pinjaman','disetujui')->select(
            DB::raw('SUM(angsuran_per_bulan * jumlah_dibayar + nominal) as total_pengeluaran')
        )->value('total_pengeluaran');

       $data['pengeluaran'] = $totalPengeluaran;
        

       $data['laba'] = $totalPendapatan - $totalPengeluaran;

       // Ambil data pinjaman yang disetujui

    // 1. Ambil data Pinjaman (Uang Keluar)
        $riwayatPinjaman = Pinjaman::where('status_pinjaman', 'disetujui')
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Ambil data Pembayaran Angsuran (Uang Masuk)
        $riwayatPembayaran = Pembayaran::where('status', 'berhasil')
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Gabungkan menjadi satu koleksi 'arus_kas'
        $arus_kas = collect();

        // Masukkan data Pinjaman ke koleksi (sebagai pengeluaran)
        foreach ($riwayatPinjaman as $pinjam) {
            $arus_kas->push([
                'tanggal'    => $pinjam->created_at, // simpan object carbon untuk sorting
                'keterangan' => 'Pemberian Pinjaman: ' . ($pinjam->nama_anggota ?? 'Anggota'),
                'masuk'      => 0,
                'keluar'     => $pinjam->nominal,
            ]);
        }

        // Masukkan data Pembayaran ke koleksi (sebagai pemasukan)
        foreach ($riwayatPembayaran as $bayar) {
            $arus_kas->push([
                'tanggal'    => $bayar->created_at, 
                'keterangan' => 'Angsuran Masuk: ' . ($bayar->nama_anggota ?? 'Anggota'),
                'masuk'      => $bayar->nominal, // Kolom nominal dari tabel Pembayaran
                'keluar'     => 0,
            ]);
        }

        // 4. Urutkan berdasarkan tanggal terbaru & simpan ke $data
        $data['arus_kas'] = $arus_kas->sortByDesc('tanggal')->values();

        // 5. Hitung Total Global agar tidak "Undefined variable"
        $data['total_pemasukan']   = $data['arus_kas']->sum('masuk');
        $data['total_pengeluaran'] = $data['arus_kas']->sum('keluar');
        $data['saldo_akhir']       = $data['total_pemasukan'] - $data['total_pengeluaran'];
        return view('admin.laporan_keuangan',$data);
    }

    private function getArusKasData()
    {
        $riwayatPinjaman = Pinjaman::where('status_pinjaman', 'disetujui')->get();
        $riwayatPembayaran = Pembayaran::where('status', 'berhasil')->get();

        $arus_kas = collect();

        foreach ($riwayatPinjaman as $p) {
            $arus_kas->push([
                'tanggal' => $p->created_at,
                'keterangan' => 'Pinjaman: ' . ($p->nama_anggota ?? 'Anggota'),
                'masuk' => 0,
                'keluar' => $p->nominal,
            ]);
        }

        foreach ($riwayatPembayaran as $b) {
            $arus_kas->push([
                'tanggal' => $b->created_at,
                'keterangan' => 'Angsuran: ' . ($b->nama_anggota ?? 'Anggota'),
                'masuk' => $b->nominal,
                'keluar' => 0,
            ]);
        }

        return $arus_kas->sortByDesc('tanggal')->values();
    }

    // 1. Export Excel
    public function exportExcel()
    {
        $data = $this->getArusKasData();
        return Excel::download(new LaporanKeuanganExport($data), 'Laporan_Keuangan.xlsx');
    }

    // 2. Export PDF
    public function exportPdf()
    {
        $data['arus_kas'] = $this->getArusKasData();
        $data['total_pemasukan'] = $data['arus_kas']->sum('masuk');
        $data['total_pengeluaran'] = $data['arus_kas']->sum('keluar');
        $data['saldo_akhir'] = $data['total_pemasukan'] - $data['total_pengeluaran'];

        $pdf = Pdf::loadView('admin.laporan_pdf_template', $data);
        return $pdf->download('Laporan_Keuangan.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
