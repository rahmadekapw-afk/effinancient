<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Anggota; // ADDED
use App\Services\FonnteService;
class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Jika request ingin JSON (API) kembalikan JSON, kalau tidak render view
        $query = \App\Models\Notifikasi::query()->orderByDesc('tanggal');

        // support optional filter by anggota_id
        if (request()->has('anggota_id')) {
            $query->where('anggota_id', request('anggota_id'));
        }

        if (request()->wantsJson()) {
            return response()->json($query->paginate(20));
        }

        $notifikasis = $query->paginate(20);
        // jika tidak ada view, kembalikan JSON untuk memudahkan testing
        if (! view()->exists('notifikasi.index')) {
            return response()->json($notifikasis);
        }

        return view('notifikasi.index', compact('notifikasis'));
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

    
        //
    

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
    public function store(Request $request)
    {
        // ambil anggota dari session atau input (fallback)
        $anggotaId = session('anggota_id') ?? $request->input('anggota_id');
        $anggota = Anggota::where('anggota_id', $anggotaId)->first();
        if (! $anggota) {
            return redirect()->back()->withErrors('Anggota tidak ditemukan. Tidak dapat mengirim notifikasi.');
        }

        // ambil judul/isi (dukung field 'kritik' juga)
        $judul = $request->input('judul') ?? 'Kritik Saran';
        $isi   = $request->input('isi') ?? $request->input('kritik') ?? '';

        // simpan di tabel notifikasis
        Notifikasi::create([
            'anggota_id' => $anggota->anggota_id,
            'judul'      => $judul,
            'isi'        => $isi,
            'tanggal'    => now(),
        ]);

        // siapkan pesan untuk WA gateway — ambil nomor hp dari anggota (coba beberapa nama kolom)
        $phone = $anggota->no_hp ?? $anggota->phone ?? $anggota->telepon ?? null;
        if ($phone) {
            // Normalisasi nomor: hapus non-digit, ubah leading 0 -> 62
            $normalized = preg_replace('/[^0-9]/', '', $phone);
            if (substr($normalized, 0, 1) === '0') {
                $normalized = '62' . substr($normalized, 1);
            }

            // Kirim langsung via Fonnte (synchronous multipart). Jika ingin queue, ubah ke job.
            try {
                $fonnte = app(FonnteService::class);
                $message = trim(($judul ?? '') . "\n\n" . ($isi ?? ''));
                $fields = [
                    'target' => $normalized,
                    'message' => $message,
                    'countryCode' => '62',
                ];
                $resp = $fonnte->sendMultipart($fields);
                \Illuminate\Support\Facades\Log::info('WA sent (multipart)', ['to' => $normalized, 'response' => $resp]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('WA send multipart failed: ' . $e->getMessage(), ['to' => $phone]);
            }
        }

        return redirect()->back()->with('pesan_sukses', 'Notifikasi berhasil dikirim!');
    }
}

