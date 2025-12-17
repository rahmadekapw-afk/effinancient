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

class PembayaranController extends Controller
{
    /**
     * =============================
     * BAYAR PINJAMAN VIA MIDTRANS
     * =============================
     */
    public function bayarNow($pinjamanId)
    {
        $anggotaId = session('anggota_id');
        if (! $anggotaId) {
            return back()->withErrors('Session anggota tidak ditemukan');
        }

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

        $orderId = 'pembayaran-' . $pembayaran->pembayaran_id . '-' . time();

        $serverKey = config('services.midtrans.server_key');
        $endpoint = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id'      => $orderId,
                'gross_amount'  => $nominal,
            ],
            'customer_details' => [
                'first_name' => 'Anggota #' . $anggotaId,
            ],
            'item_details' => [[
                'id'       => $pinjaman->pinjaman_id,
                'price'    => $nominal,
                'quantity' => 1,
                'name'     => 'Pelunasan Pinjaman',
            ]],

            // 🔥 INI YANG PALING PENTING
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

        $pembayaran = Pembayaran::where('midtrans_order_id', $orderId)->first();

        if (! $pembayaran) {
            return redirect('dashboard/anggota')
                ->withErrors('Pembayaran tidak ditemukan');
        }

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

        $status = $payload['transaction_status'];

        if (in_array($status, ['capture', 'settlement'])) {
            $pembayaran->update([
                'status' => 'berhasil',
                'midtrans_status' => $status,
                'midtrans_response' => json_encode($payload),
            ]);

            // Update pinjaman
            $pinjaman = Pinjaman::find($pembayaran->pinjaman_id);
            if ($pinjaman) {
                $pinjaman->status_pinjaman = 'lunas';
                $pinjaman->save();
                // Buat notifikasi untuk anggota bahwa pinjaman sudah lunas
                Notifikasi::create([
                    'anggota_id' => $pembayaran->anggota_id,
                    'judul'      => 'Pembayaran Lunas',
                    'isi'        => 'Pembayaran pinjaman #' . $pinjaman->pinjaman_id . ' sebesar Rp ' . number_format($pembayaran->nominal, 0, ',', '.') . ' telah lunas. Tidak ada tagihan lagi untuk dibayar.',
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

        if (in_array($status, ['deny', 'cancel', 'expire'])) {
            $pembayaran->update([
                'status' => 'gagal',
                'midtrans_status' => $status,
            ]);
        }

        return response('OK', 200);
    }
}
