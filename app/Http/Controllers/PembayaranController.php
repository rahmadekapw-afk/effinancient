<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Pembayaran;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // ADDED

class PembayaranController extends Controller
{
    /**
     * =============================
     * BAYAR PINJAMAN VIA MIDTRANS
     * =============================
     */
    public function bayarNow($pinjamanId)
    {
        $anggota = $this->getAuthenticatedAnggota();
        if (! $anggota) {
            return back()->withErrors('Akses ditolak. Silakan login sebagai anggota.');
        }
        $anggotaId = $anggota->anggota_id;

        $pinjaman = Pinjaman::where('pinjaman_id', $pinjamanId)
            ->where('anggota_id', $anggotaId)
            ->firstOrFail();

        $nominal = (int) $pinjaman->nominal;

        // Simpan pembayaran PENDING
        $pembayaran = Pembayaran::create([
            'anggota_id'    => $anggotaId,
            'pinjaman_id'   => $pinjaman->pinjaman_id,
            'metode'        => 'midtrans',
            'nominal'       => $nominal,
            'tanggal_bayar' => now(),
            'status'        => 'pending',
        ]);

        // GANTI: order id singkat dan ambil nama anggota untuk tampil sebagai customer
        $orderId = 'INV' . $pembayaran->pembayaran_id . '-' . substr(sha1(time() . rand()), 0, 6);
        $namaAnggota = $anggota->nama ?? 'Anggota #' . $anggotaId;

        $serverKey = config('services.midtrans.server_key');
        $endpoint = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => $namaAnggota,
                'email'      => $anggota->email ?? '',
            ],
            'item_details' => [[
                'id'       => $pinjaman->pinjaman_id,
                'price'    => $nominal,
                'quantity' => 1,
                'name'     => 'Pembayaran Pinjaman #' . $pinjaman->pinjaman_id . ' — Pelunasan (Rp ' . number_format($nominal, 0, ',', '.') . ')',
            ]],
            'callbacks' => [
                'finish' => url('/midtrans/return'),
            ],
        ];

        $response = Http::withBasicAuth($serverKey, '')
            ->post($endpoint, $payload);

        $body = $response->json();

        // Simpan order_id Midtrans
        $pembayaran->update([
            'midtrans_order_id' => $orderId,
            'midtrans_response' => json_encode($body),
        ]);

        if (! isset($body['redirect_url'])) {
            return back()->withErrors('Gagal mendapatkan URL pembayaran');
        }

        return redirect($body['redirect_url']);
    }

    /**
     * =============================
     * RETURN URL (USER KEMBALI)
     * =============================
     */
    public function midtransReturn(Request $request)
    {
        $orderId = $request->order_id;

        // Cari pembayaran berdasarkan order id Midtrans
        $pembayaran = Pembayaran::where('midtrans_order_id', $orderId)->first();

        // Jika tidak ditemukan, arahkan ke beranda dengan pesan error
        if (! $pembayaran) {
            return redirect('/')
                ->withErrors('Pembayaran tidak ditemukan. Jika Anda baru saja membayar, status akan diperbarui otomatis dalam beberapa menit.');
        }

        // Pastikan logout dari akun admin/auth guard agar view tidak lagi menampilkan admin
        Auth::logout();

        // Hapus kemungkinan key session admin/role yang tersisa
        session()->forget([
            'admin_id', 'is_admin', 'user_role', 'role',
            'user', 'id', 'email', // common keys
        ]);

        // Regenerate session id lalu set session anggota
        session()->regenerate();
        session()->put('anggota_id', $pembayaran->anggota_id);

        // Periksa status terakhir langsung ke Midtrans untuk memastikan status di DB tidak tetap "pending"
        $serverKey = config('services.midtrans.server_key');
        $statusEndpoint = config('services.midtrans.is_production')
            ? "https://api.midtrans.com/v2/{$orderId}/status"
            : "https://api.sandbox.midtrans.com/v2/{$orderId}/status";

        try {
            $statusResp = Http::withBasicAuth($serverKey, '')->get($statusEndpoint);
            $statusBody = $statusResp->json();

            $txStatus = strtolower($statusBody['transaction_status'] ?? '');
            $txId = $statusBody['transaction_id'] ?? null;

            if (in_array($txStatus, ['capture', 'settlement', 'success'])) {
                $pembayaran->update([
                    'status' => 'berhasil',
                    'midtrans_status' => $txStatus,
                    'midtrans_transaction_id' => $txId,
                    'midtrans_response' => json_encode($statusBody),
                ]);

                // PROSES ANGSURAN: gunakan helper untuk menerapkan logika angsuran yang Anda minta
                $this->processSuccessfulPayment($pembayaran);

                // Jika ini pembayaran per-angsuran, tandai pembayaran pending lain untuk angsuran ini sebagai gagal
                if (! empty($pembayaran->angsuran_ke)) {
                    Pembayaran::where('pinjaman_id', $pembayaran->pinjaman_id)
                        ->where('angsuran_ke', $pembayaran->angsuran_ke)
                        ->where('pembayaran_id', '!=', $pembayaran->pembayaran_id)
                        ->where('status', 'pending')
                        ->update([
                            'status' => 'gagal',
                            'midtrans_status' => 'cancelled_by_system',
                            'midtrans_response' => json_encode(['message' => 'Dibatalkan karena angsuran sudah dibayar.']),
                        ]);
                }
            } elseif (in_array($txStatus, ['deny', 'cancel', 'expire'])) {
                $pembayaran->update([
                    'status' => 'gagal',
                    'midtrans_status' => $txStatus,
                    'midtrans_transaction_id' => $txId,
                    'midtrans_response' => json_encode($statusBody),
                ]);
            } else {
                // simpan response untuk referensi tapi biarkan status tetap pending
                $pembayaran->update([
                    'midtrans_status' => $txStatus ?: $pembayaran->midtrans_status,
                    'midtrans_transaction_id' => $txId ?: $pembayaran->midtrans_transaction_id,
                    'midtrans_response' => json_encode($statusBody),
                ]);
            }
        } catch (\Exception $e) {
            Log::warning('Midtrans status check failed: ' . $e->getMessage());
            // jangan gagalkan alur return, user tetap diarahkan ke dashboard anggota
        }

        // Pastikan redirect ke dashboard anggota (tidak ke admin)
        return redirect('dashboard/anggota')
            ->with('pesan_sukses', 'Pembayaran sedang diproses. Status akan diperbarui otomatis.');
    }

    /**
     * =============================
     * NOTIFICATION MIDTRANS
     * =============================
     */
    public function midtransNotification(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Notification', $payload);

        $orderId        = $payload['order_id'] ?? null;
        $statusCode     = $payload['status_code'] ?? null;
        $grossAmount    = $payload['gross_amount'] ?? null;
        $signature      = $payload['signature_key'] ?? null;

        if (! $orderId || ! $signature) {
            return response('Invalid', 400);
        }

        $serverKey = config('services.midtrans.server_key');
        $expected  = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if (! hash_equals($expected, $signature)) {
            return response('Forbidden', 403);
        }

        $pembayaran = Pembayaran::where('midtrans_order_id', $orderId)->first();
        if (! $pembayaran) {
            return response('OK', 200);
        }

        $status = strtolower($payload['transaction_status'] ?? '');
        $txId = $payload['transaction_id'] ?? ($payload['transaction_id'] ?? null);

        if (in_array($status, ['capture', 'settlement', 'success'])) {
            $pembayaran->update([
                'status' => 'berhasil',
                'midtrans_status' => $status,
                'midtrans_transaction_id' => $txId,
                'midtrans_response' => json_encode($payload),
            ]);

            // PROSES ANGSURAN: gunakan helper untuk menerapkan logika angsuran yang Anda minta
            $this->processSuccessfulPayment($pembayaran);

            // Jika ini pembayaran per-angsuran, tandai pembayaran pending lain untuk angsuran ini sebagai gagal
            if (! empty($pembayaran->angsuran_ke)) {
                Pembayaran::where('pinjaman_id', $pembayaran->pinjaman_id)
                    ->where('angsuran_ke', $pembayaran->angsuran_ke)
                    ->where('pembayaran_id', '!=', $pembayaran->pembayaran_id)
                    ->where('status', 'pending')
                    ->update([
                        'status' => 'gagal',
                        'midtrans_status' => 'cancelled_by_system',
                        'midtrans_response' => json_encode(['message' => 'Dibatalkan karena angsuran sudah dibayar.']),
                    ]);
            }
        } elseif (in_array($status, ['deny', 'cancel', 'expire'])) {
            $pembayaran->update([
                'status' => 'gagal',
                'midtrans_status' => $status,
                'midtrans_transaction_id' => $txId,
                'midtrans_response' => json_encode($payload),
            ]);
        } else {
            // update response/status stamp sementara
            $pembayaran->update([
                'midtrans_status' => $status ?: $pembayaran->midtrans_status,
                'midtrans_transaction_id' => $txId ?: $pembayaran->midtrans_transaction_id,
                'midtrans_response' => json_encode($payload),
            ]);
        }

        return response('OK', 200);
    }

    /**
     * Inisiasi Midtrans untuk satu angsuran (per installment)
     * Request: pinjaman_id, angsuran_ke, nominal
     */
    public function bayarAngsuran(Request $request)
    {
        $anggota = $this->getAuthenticatedAnggota();
        if (! $anggota) {
            return response()->json(['error' => 'Session anggota tidak ditemukan atau bukan anggota'], 401);
        }
        $anggotaId = $anggota->anggota_id;

        $pinjamanId = $request->input('pinjaman_id');
        $angsuranKe = (int) $request->input('angsuran_ke');
        $nominal    = (int) $request->input('nominal');

        if (! $pinjamanId || $nominal <= 0 || $angsuranKe < 1) {
            return response()->json(['error' => 'Parameter tidak lengkap atau tidak valid'], 400);
        }

        $pinjaman = Pinjaman::where('pinjaman_id', $pinjamanId)
            ->where('anggota_id', $anggotaId)
            ->firstOrFail();

        // Simpan pembayaran pending untuk angsuran ini
        $pembayaran = Pembayaran::create([
            'anggota_id'    => $anggotaId,
            'pinjaman_id'   => $pinjaman->pinjaman_id,
            'angsuran_ke'   => $angsuranKe,
            'metode'        => 'midtrans',
            'nominal'       => $nominal,
            'tanggal_bayar' => now(),
            'status'        => 'pending',
        ]);

        // GANTI: order id singkat dan tampilkan deskripsi angsuran yang menarik
        $orderId = 'INV' . $pembayaran->pembayaran_id . '-' . substr(sha1(time() . rand()), 0, 6);
        $namaAnggota = $anggota->nama ?? 'Anggota #' . $anggotaId;

        $serverKey = config('services.midtrans.server_key');
        $endpoint = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => $namaAnggota,
                'email'      => $anggota->email ?? '',
            ],
            'item_details' => [[
                'id'       => $pinjaman->pinjaman_id,
                'price'    => $nominal,
                'quantity' => 1,
                'name'     => 'Angsuran ke-' . $angsuranKe . ' — Pinjaman #' . $pinjaman->pinjaman_id . ' (Rp ' . number_format($nominal, 0, ',', '.') . ')',
            ]],
            'callbacks' => [
                'finish' => url('/midtrans/return'),
            ],
        ];

        $response = Http::withBasicAuth($serverKey, '')
            ->post($endpoint, $payload);

        $body = $response->json();

        $pembayaran->update([
            'midtrans_order_id' => $orderId,
            'midtrans_response' => json_encode($body),
        ]);

        // Jika Midtrans mengembalikan token (untuk Snap popup), kembalikan token
        if (isset($body['token']) && $body['token']) {
            return response()->json(['token' => $body['token'], 'pembayaran_id' => $pembayaran->pembayaran_id]);
        }

        // Beberapa versi mungkin mengembalikan snap_token
        if (isset($body['snap_token']) && $body['snap_token']) {
            return response()->json(['token' => $body['snap_token'], 'pembayaran_id' => $pembayaran->pembayaran_id]);
        }

        // Fallback ke redirect_url kalau ada
        if (isset($body['redirect_url']) && $body['redirect_url']) {
            return response()->json(['redirect_url' => $body['redirect_url'], 'pembayaran_id' => $pembayaran->pembayaran_id]);
        }

        return response()->json(['error' => 'Gagal mendapatkan token atau URL pembayaran'], 500);
    }

    /**
     * Mulai alur pembayaran per-angsuran tapi sebagai redirect (full-page).
     * URL: /dashboard/anggota/pinjaman/bayar-now-angsuran/{pinjaman}/{angsuran}/{nominal}
     */
    public function bayarNowAngsuran($pinjamanId, $angsuranKe, $nominal)
    {
        $anggota = $this->getAuthenticatedAnggota();
        if (! $anggota) {
            return back()->withErrors('Akses ditolak. Silakan login sebagai anggota.');
        }
        $anggotaId = $anggota->anggota_id;

        $pinjaman = Pinjaman::where('pinjaman_id', $pinjamanId)
            ->where('anggota_id', $anggotaId)
            ->firstOrFail();

        $nominal = (int) $nominal;

        // Simpan pembayaran pending untuk angsuran ini
        $pembayaran = Pembayaran::create([
            'anggota_id'    => $anggotaId,
            'pinjaman_id'   => $pinjaman->pinjaman_id,
            'angsuran_ke'   => (int) $angsuranKe,
            'metode'        => 'midtrans',
            'nominal'       => $nominal,
            'tanggal_bayar' => now(),
            'status'        => 'pending',
        ]);

        // GANTI: order id singkat dan deskripsi angsuran menarik untuk redirect flow
        $orderId = 'INV' . $pembayaran->pembayaran_id . '-' . substr(sha1(time() . rand()), 0, 6);
        $namaAnggota = $anggota->nama ?? 'Anggota #' . $anggotaId;

        $serverKey = config('services.midtrans.server_key');
        $endpoint = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => $namaAnggota,
                'email'      => $anggota->email ?? '',
            ],
            'item_details' => [[
                'id'       => $pinjaman->pinjaman_id,
                'price'    => $nominal,
                'quantity' => 1,
                'name'     => 'Angsuran ke-' . $angsuranKe . ' — Pinjaman #' . $pinjaman->pinjaman_id . ' (Rp ' . number_format($nominal, 0, ',', '.') . ')',
            ]],
            'callbacks' => [
                'finish' => url('/midtrans/return'),
            ],
        ];

        $response = Http::withBasicAuth($serverKey, '')->post($endpoint, $payload);
        $body = $response->json();

        $pembayaran->update([
            'midtrans_order_id' => $orderId,
            'midtrans_response' => json_encode($body),
        ]);

        // Jika ada redirect_url dari Midtrans, langsung redirect user ke sana (full-page)
        if (isset($body['redirect_url']) && $body['redirect_url']) {
            return redirect($body['redirect_url']);
        }

        // Jika hanya token tersedia, render simple page that opens snap.pay(token)
        $token = $body['token'] ?? ($body['snap_token'] ?? null);
        if ($token) {
            return response()->view('midtrans.redirect', ['token' => $token]);
        }

        return back()->withErrors('Gagal memulai pembayaran Midtrans');
    }

    /**
     * Cek status pinjaman untuk keperluan frontend (polling setelah pembayaran)
     */
    public function pinjamanStatus($pinjamanId)
    {
        $anggota = $this->getAuthenticatedAnggota();
        if (! $anggota) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $anggotaId = $anggota->anggota_id;

        $pinjaman = Pinjaman::where('pinjaman_id', $pinjamanId)
            ->where('anggota_id', $anggotaId)
            ->first();

        if (! $pinjaman) {
            return response()->json(['error' => 'Not found'], 404);
        }

        // Ambil daftar angsuran yang sudah berstatus 'berhasil' untuk pinjaman ini
        $angsuranTerbayar = Pembayaran::where('pinjaman_id', $pinjamanId)
            ->where('status', 'berhasil')
            ->whereNotNull('angsuran_ke')
            ->pluck('angsuran_ke')
            ->unique()
            ->values()
            ->all();

        return response()->json([
            'pinjaman_id'      => $pinjaman->pinjaman_id,
            'status_pinjaman'  => $pinjaman->status_pinjaman,
            'jumlah_dibayar'   => (float) ($pinjaman->jumlah_dibayar ?? 0),
            'nominal'          => (float) $pinjaman->nominal,
            'angsuran_terbayar'=> $angsuranTerbayar, // frontend: sembunyikan/tandai angsuran ini sebagai lunas
        ]);
    }

    /**
     * Kembalikan daftar pembayaran (full texts sesuai permintaan) terurut ascending by pembayaran_id
     */
    public function pembayaranFullList()
    {
        $columns = [
            'pembayaran_id',
            'midtrans_order_id',
            'midtrans_transaction_id',
            'midtrans_status',
            'midtrans_response',
            'anggota_id',
            'simpanan_id',
            'pinjaman_id',
            'angsuran_ke',
            'metode',
            'jenis',
            'nominal',
            'tanggal_bayar',
            'status',
            'created_at',
            'updated_at',
        ];

        $list = Pembayaran::select($columns)
            ->orderBy('pembayaran_id', 'asc')
            ->get();

        return response()->json($list);
    }

    // Tambahkan helper untuk memastikan session benar-benar milik anggota yang ada di DB
    protected function getAuthenticatedAnggota()
    {
        $anggotaId = session('anggota_id');
        if (! $anggotaId) {
            return null;
        }
        return Anggota::where('anggota_id', $anggotaId)->first();
    }

    // Baru: helper untuk menerapkan logika angsuran sesuai instruksi
    protected function processSuccessfulPayment(Pembayaran $pembayaran)
    {
        $pinjaman = Pinjaman::find($pembayaran->pinjaman_id);
        if (! $pinjaman) {
            return;
        }

        // WAJIB: hentikan proses jika pinjaman sudah lunas
        if (isset($pinjaman->status_pinjaman) && $pinjaman->status_pinjaman === 'lunas') {
            return;
        }

        // jumlah yang dibayar sekarang
        $paidAmount = (float) $pembayaran->nominal;

        // tambahkan total jumlah_dibayar dengan jumlah pembayaran ini
        $pinjaman->jumlah_dibayar = $pinjaman->jumlah_dibayar + 1;

        


        // kurangi sisa pinjaman dengan jumlah yang dibayar
        $pinjaman->nominal = max(0, (float) $pinjaman->nominal - $paidAmount);

        // jika sisa <= 0 maka lunas
        if ($pinjaman->nominal <= 0) {
            $pinjaman->status_pinjaman = 'lunas';
            $pinjaman->nominal = 0;
        }

        $pinjaman->save();

        // Notifikasi pembayaran diterima
        $sisa = $pinjaman->nominal;
        Notifikasi::create([
            'anggota_id' => $pembayaran->anggota_id,
            'judul'      => 'Pembayaran Diterima',
            'isi'        => 'Pembayaran sebesar Rp ' . number_format($pembayaran->nominal, 0, ',', '.') . ' telah diterima. Sisa tagihan: Rp ' . number_format($sisa, 0, ',', '.') . '.',
            'tanggal'    => now(),
        ]);

        // Jika lunas, buat notifikasi dan tandai pembayaran pending lain sebagai gagal
        if ($pinjaman->status_pinjaman === 'lunas') {
            Notifikasi::create([
                'anggota_id' => $pembayaran->anggota_id,
                'judul'      => 'Pembayaran Lunas',
                'isi'        => 'Pembayaran pinjaman #' . $pinjaman->pinjaman_id . ' telah lunas. Terima kasih.',
                'tanggal'    => now(),
            ]);

            // Tandai semua pembayaran lain yang masih 'pending' untuk pinjaman ini sebagai 'gagal'
            Pembayaran::where('pinjaman_id', $pinjaman->pinjaman_id)
                ->where('pembayaran_id', '!=', $pembayaran->pembayaran_id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'gagal',
                    'midtrans_status' => 'cancelled_by_system',
                    'midtrans_response' => json_encode(['message' => 'Dibatalkan karena pinjaman sudah lunas oleh pembayaran lain.']),
                ]);
        }
    }
}