<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Pembayaran;
use App\Models\Tren_rupiah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $data['saldo'] = Anggota::where('anggota_id', session('anggota_id'))->value('saldo');
        // Ambil pinjaman yang masih memiliki sisa pembayaran (jumlah_dibayar < nominal)
        // ini lebih tahan terhadap kondisi di mana status_pinjaman mungkin belum sinkron
    $data['pinjaman'] = Pinjaman::where('anggota_id', session('anggota_id'))
            ->where('status_pinjaman', 'disetujui')->whereRaw('COALESCE(jumlah_dibayar, 0) < nominal')->get();

    $data ['total_nominal'] = Pinjaman::where('anggota_id', session('anggota_id'))
            ->where('status_pinjaman', 'disetujui')
            ->sum(DB::raw('nominal + angsuran_per_bulan * jumlah_dibayar'));
    
    $data['sisa_pinjaman'] = Pinjaman::where('anggota_id', session('anggota_id'))
            ->where('status_pinjaman', 'disetujui')
            ->sum(DB::raw('nominal'));
    

    $anggota = Anggota::where('anggota_id', session('anggota_id'))->first();

    $data['saldo'] = $anggota ? $anggota->saldo : 0;
    $data['hari_raya'] = $anggota ? $anggota->simpanan_hari_raya : 0;
    $data['pokok'] = $anggota ? $anggota->simpanan_pokok : 0;
    $data['wajib'] = $anggota ? $anggota->simpanan_wajib : 0;

    $data['total_saldo'] = $data['saldo'] + $data['hari_raya'] + $data['pokok'] +  $data['wajib'] ;
    $data['progres_pinjaman'] = 0;

        if ($data['total_nominal'] > 0) {
            $terbayar = $data['total_nominal'] - $data['sisa_pinjaman'];

            $data['progres_pinjaman'] = round(
                ($terbayar / $data['total_nominal']) * 100,
                2
            );
        }

    // ==logita c4.5
     // ===== INPUT =====

    $terbaru = Tren_rupiah::orderByRaw(
    "STR_TO_DATE(`Date`, '%d/%m/%y') DESC"
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Rata-rata HARI TERBARU (Close + High + Low + Open) / 4
        |--------------------------------------------------------------------------
        */
        $rataRataTerbaru = (
            (float) $terbaru->Close +
            (float) $terbaru->High +
            (float) $terbaru->Low +
            (float) $terbaru->Open
        ) / 4;
        $totalClose = Tren_rupiah::sum('Close');
        $totalHigh  = Tren_rupiah::sum('High');
        $totalLow   = Tren_rupiah::sum('Low');
        $totalOpen  = Tren_rupiah::sum('Open');

        $jumlahData = Tren_rupiah::count();

        $keseluruhan_rata = 0;

        if ($jumlahData > 0) {
            $totalSemuaKolom = $totalClose + $totalHigh + $totalLow + $totalOpen;
            $keseluruhan_rata = $totalSemuaKolom / ($jumlahData * 4);
        }
        
        $trenrupiah = ( $rataRataTerbaru + $keseluruhan_rata) / 2;

        $simpanan_sehat = Anggota::where('anggota_id',session('anggota_id'))->value('saldo');

        $pinjaman_berapa_kali = Pinjaman::where('anggota_id',session('anggota_id'))->count();

        $total_pembayaran_pinjaman = Pembayaran::where('anggota_id',session('anggota_id'))
            ->where('status','berhasil')
            ->sum('nominal');


        /* =========================================================
         * 2. DATA TRAINING (HISTORIS – WAJIB C4.5)
         * ========================================================= */
        $dataTraining = [
            ['tren'=>'rendah','simpanan'=>'besar','kali'=>'sering','bayar'=>'besar','kelas'=>'tinggi'],
            ['tren'=>'sedang','simpanan'=>'sedang','kali'=>'jarang','bayar'=>'sedang','kelas'=>'menengah'],
            ['tren'=>'tinggi','simpanan'=>'kecil','kali'=>'jarang','bayar'=>'kecil','kelas'=>'rendah'],
            ['tren'=>'sedang','simpanan'=>'besar','kali'=>'sering','bayar'=>'besar','kelas'=>'tinggi'],
            ['tren'=>'rendah','simpanan'=>'kecil','kali'=>'jarang','bayar'=>'kecil','kelas'=>'rendah'],
        ];


        /* =========================================================
         * 3. FUNGSI UTAMA ALGORITMA C4.5
         * ========================================================= */
        function entropy($data){
            $total = count($data);
            $kelas = array_count_values(array_column($data,'kelas'));
            $entropy = 0;
            foreach($kelas as $count){
                $p = $count / $total;
                $entropy -= $p * log($p,2);
            }
            return $entropy;
        }

        function informationGain($data,$atribut){
            $entropyAwal = entropy($data);
            $total = count($data);

            $subset = [];
            foreach($data as $row){
                $subset[$row[$atribut]][] = $row;
            }

            $entropyAtribut = 0;
            foreach($subset as $sub){
                $entropyAtribut += (count($sub)/$total) * entropy($sub);
            }

            return $entropyAwal - $entropyAtribut;
        }

        function splitInfo($data,$atribut){
            $total = count($data);
            $nilai = array_count_values(array_column($data,$atribut));

            $split = 0;
            foreach($nilai as $count){
                $p = $count / $total;
                $split -= $p * log($p,2);
            }
            return $split;
        }

        function gainRatio($data,$atribut){
            $gain = informationGain($data,$atribut);
            $split = splitInfo($data,$atribut);
            return ($split == 0) ? 0 : $gain / $split;
        }


        /* =========================================================
         * 4. MENENTUKAN ROOT NODE (GAIN RATIO TERBESAR)
         * ========================================================= */
        $atribut = ['tren','simpanan','kali','bayar'];
        $gainRatio = [];

        foreach($atribut as $a){
            $gainRatio[$a] = gainRatio($dataTraining,$a);
        }

        arsort($gainRatio);
        $root = array_key_first($gainRatio);


        /* =========================================================
         * 5. DISKRITISASI DATA UJI (DATA DB → KATEGORI)
         * ========================================================= */
        $dataUji = [
            'tren' => $trenrupiah >= 14000 ? 'tinggi' :
                      ($trenrupiah >= 13500 ? 'sedang' : 'rendah'),

            'simpanan' => $simpanan_sehat >= 70000000 ? 'besar' :
                          ($simpanan_sehat >= 30000000 ? 'sedang' : 'kecil'),

            'kali' => $pinjaman_berapa_kali >= 4 ? 'sering' : 'jarang',

            'bayar' => $total_pembayaran_pinjaman >= 80000000 ? 'besar' :
                       ($total_pembayaran_pinjaman >= 30000000 ? 'sedang' : 'kecil')
        ];


        /* =========================================================
         * 6. KLASIFIKASI (HASIL AKHIR / LEAF NODE)
         * ========================================================= */
        switch($dataUji[$root]){
            case 'besar':
                $ambang_batas_pinjaman = 150000000;
                break;

            case 'sedang':
                $ambang_batas_pinjaman = 75000000;
                break;

            default:
                $ambang_batas_pinjaman = 30000000;
        }


        /* =========================================================
         * 7. OUTPUT
         * ========================================================= */
        $data['batasan_pinjaman'] = $ambang_batas_pinjaman;


     return view('anggota.anggota',$data);
    }


    
    public function profile()
    {
        $id = session('anggota_id');   // ambil ID anggota yg login

    // Ambil data anggota berdasarkan ID
       $anggota = Anggota::find($id);

        return view('anggota.profile', compact('anggota'));


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
    public function update(Request $request)
    {
        $anggota = Anggota::where('anggota_id', session('anggota_id'))->first();

        $anggota->update([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
        ]);

        return redirect()->back()->with('pesan_sukses', 'Profil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
    }

    }

