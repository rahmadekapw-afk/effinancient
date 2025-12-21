<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\Anggota;
use App\Services\FonnteService;

class WaGatewayController extends Controller
{
    /**
     * Send a stored Notifikasi to the related Anggota's phone.
     * Route: POST /wa/send-notifikasi/{notifikasi}
     */
    public function sendNotifikasi(Request $request, $notifikasi)
    {
        $notif = Notifikasi::where('notifikasi_id', $notifikasi)->first();
        if (! $notif) {
            return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
        }

        // Prefer anggota_id dari notifikasi, fallback ke query param anggota_id
        $anggotaId = $notif->anggota_id ?? $request->input('anggota_id');
        if (! $anggotaId) {
            return response()->json(['error' => 'Anggota tidak ditentukan'], 400);
        }

        $anggota = Anggota::where('anggota_id', $anggotaId)->first();
        if (! $anggota || empty($anggota->no_hp)) {
            return response()->json(['error' => 'Nomor anggota tidak ditemukan'], 404);
        }

        $phone = $anggota->no_hp;
        $normalized = preg_replace('/[^0-9]/', '', $phone);
        if (substr($normalized, 0, 1) === '0') {
            $normalized = '62' . substr($normalized, 1);
        }

        $title = $notif->judul ?? '';
        $body  = $notif->isi ?? '';
        $message = trim($title . "\n\n" . $body);

        try {
            $fonnte = app(FonnteService::class);
            // use multipart send to match provider expectations
            $fields = [
                'target' => $normalized,
                'message' => $message,
                'countryCode' => '62',
            ];
            $resp = $fonnte->sendMultipart($fields);
            \Illuminate\Support\Facades\Log::info('WA sent (multipart)', ['to' => $normalized, 'response' => $resp]);
            return response()->json(['success' => true, 'response' => $resp]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('WA send multipart failed: ' . $e->getMessage(), ['to' => $normalized]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Stateless test endpoint to send arbitrary phone+message.
     * POST /wa/test-send { phone, message }
     */
    public function testSend(Request $request)
    {
        $phone = $request->input('phone');
        $message = $request->input('message');

        if (! $phone || ! $message) {
            return response()->json(['error' => 'phone and message are required'], 400);
        }

        $normalized = preg_replace('/[^0-9]/', '', $phone);
        if (substr($normalized, 0, 1) === '0') {
            $normalized = '62' . substr($normalized, 1);
        }

        try {
            $fonnte = app(FonnteService::class);
            $resp = $fonnte->send($normalized, $message, '62');
            \Illuminate\Support\Facades\Log::info('WA test sent', ['to' => $normalized, 'response' => $resp]);
            return response()->json(['success' => true, 'response' => $resp]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('WA test send failed: ' . $e->getMessage(), ['to' => $normalized]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Test endpoint that reads phone from DB (anggota) or from notifikasi record.
     * POST /wa/test-send-member { anggota_id OR notifikasi_id }
     */
    public function testSendMember(Request $request)
    {
        $anggotaId = $request->input('anggota_id');
        $notifikasiId = $request->input('notifikasi_id');

        $phone = null;
        $message = null;

        if ($notifikasiId) {
            $notif = Notifikasi::where('notifikasi_id', $notifikasiId)->first();
            if (! $notif) {
                return response()->json(['error' => 'Notifikasi tidak ditemukan'], 404);
            }
            $message = trim(($notif->judul ?? '') . "\n\n" . ($notif->isi ?? ''));
            $anggotaId = $notif->anggota_id ?? $anggotaId;
        }

        if ($anggotaId) {
            $anggota = Anggota::where('anggota_id', $anggotaId)->first();
            if (! $anggota || empty($anggota->no_hp)) {
                return response()->json(['error' => 'Anggota atau nomor tidak ditemukan'], 404);
            }
            $phone = $anggota->no_hp;
        }

        if (! $phone) {
            return response()->json(['error' => 'anggota_id or notifikasi_id required'], 400);
        }

        if (! $message) {
            $message = $request->input('message') ?? 'Test pesan dari WA gateway';
        }

        $normalized = preg_replace('/[^0-9]/', '', $phone);
        if (substr($normalized, 0, 1) === '0') {
            $normalized = '62' . substr($normalized, 1);
        }

        try {
            $fonnte = app(FonnteService::class);
            $resp = $fonnte->send($normalized, $message, '62');
            \Illuminate\Support\Facades\Log::info('WA test member sent', ['to' => $normalized, 'response' => $resp]);
            return response()->json(['success' => true, 'response' => $resp]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning('WA test member send failed: ' . $e->getMessage(), ['to' => $normalized]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
