<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Http\Controllers\PembayaranController;

class SimulateMidtransNotification extends Command
{
    protected $signature = 'midtrans:simulate {--pembayaran_id=} {--order_id=} {--status=settlement}';
    protected $description = 'Simulasikan notifikasi Midtrans secara lokal (tanpa ngrok)';

    public function handle()
    {
        $pembayaranId = $this->option('pembayaran_id');
        $orderId = $this->option('order_id');
        $status = $this->option('status') ?: 'settlement';

        if ($pembayaranId) {
            $pembayaran = Pembayaran::find($pembayaranId);
        } elseif ($orderId) {
            $pembayaran = Pembayaran::where('midtrans_order_id', $orderId)->first();
        } else {
            $this->error('Berikan --pembayaran_id atau --order_id');
            return 1;
        }

        if (! $pembayaran) {
            $this->error('Pembayaran tidak ditemukan');
            return 1;
        }

        $orderId = $pembayaran->midtrans_order_id ?: $orderId;
        $statusCode = '200';
        $grossAmount = (string) $pembayaran->nominal;

        $serverKey = config('services.midtrans.server_key');
        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        $payload = [
            'order_id' => $orderId,
            'status_code' => $statusCode,
            'gross_amount' => $grossAmount,
            'signature_key' => $signature,
            'transaction_status' => $status,
        ];

        $this->info('Mengirim payload simulasi: ' . json_encode($payload));

        // Buat Request dan panggil langsung controller (tanpa HTTP)
        $request = Request::create('/midtrans/notification', 'POST', $payload);

        $controller = new PembayaranController();
        $response = $controller->midtransNotification($request);

        $this->info('Response: ' . $response->getContent());

        $this->info('Selesai. Periksa tabel `notifikasis` dan status pinjaman terkait.');
        return 0;
    }
}
