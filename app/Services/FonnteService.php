<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class FonnteService
{
    protected string $apiUrl;
    protected ?string $token;

    public function __construct()
    {
        // ambil dari config, BUKAN hardcode
        $this->apiUrl = config('services.fonnte.url') ?? '';
        $this->token  = config('services.fonnte.token') ?? null;
    }

    /**
     * Kirim pesan WhatsApp via Fonnte
     */
    public function send(string $target, string $message)
    {
        if (empty($this->apiUrl)) {
            throw new Exception('Fonnte API URL is not configured');
        }

        // build attempt list
        $attempts = [];
        if (!empty($this->token)) {
            $attempts[] = [
                'headers' => ['Authorization' => 'Bearer ' . $this->token],
                'body'    => ['target' => $target, 'message' => $message],
            ];
            $attempts[] = [
                'headers' => ['Authorization' => $this->token],
                'body'    => ['target' => $target, 'message' => $message],
            ];
            $attempts[] = [
                'headers' => [],
                'body'    => ['token' => $this->token, 'target' => $target, 'message' => $message],
            ];
            $attempts[] = [
                'headers' => [],
                'body'    => ['token' => $this->token, 'to' => $target, 'message' => $message],
            ];
        }

        // fallback attempts without token
        $attempts[] = [
            'headers' => [],
            'body'    => ['target' => $target, 'message' => $message],
        ];
        $attempts[] = [
            'headers' => [],
            'body'    => ['to' => $target, 'message' => $message],
        ];

        $errors = [];
        $lastResponse = null;

        foreach ($attempts as $idx => $attempt) {
            $n = $idx + 1;

            // log request with masked token
            $loggedHeaders = $attempt['headers'];
            if (isset($loggedHeaders['Authorization'])) {
                $val = $loggedHeaders['Authorization'];
                $loggedHeaders['Authorization'] = self::maskToken($val);
            }

            Log::info('Fonnte request attempt', ['attempt' => $n, 'url' => $this->apiUrl, 'headers' => $loggedHeaders, 'body' => $attempt['body']]);

            try {
                $resp = Http::withHeaders($attempt['headers'])->post($this->apiUrl, $attempt['body']);
            } catch (Exception $e) {
                $errors[] = "attempt #$n exception: " . $e->getMessage();
                Log::warning('Fonnte request exception', ['attempt' => $n, 'exception' => $e->getMessage()]);
                continue;
            }

            $lastResponse = $resp;
            Log::info('Fonnte response attempt', ['attempt' => $n, 'status' => $resp->status(), 'body' => $resp->body()]);

            if ($resp->successful()) {
                return $resp->json();
            }

            $errors[] = "attempt #$n failed: status=" . $resp->status() . " body=" . $resp->body();
        }

        Log::error('Fonnte all attempts failed', ['errors' => $errors]);

        $msg = "Fonnte Error: all attempts failed. " . implode(' | ', $errors);
        if ($lastResponse) {
            $msg .= ' | last_body=' . $lastResponse->body();
        }

        throw new Exception($msg);
    }

    private static function maskToken(string $value): string
    {
        // mask token but keep last 4 chars to help debugging
        $len = strlen($value);
        if ($len <= 8) {
            return '****';
        }
        return substr($value, 0, 4) . str_repeat('*', max(0, $len - 8)) . substr($value, -4);
    }

    public function sendMultipart(array $fields, ?string $filePath = null): array
    {
        if (empty($this->apiUrl)) {
            throw new Exception('Fonnte API URL is not configured');
        }

        $headers = [];
        if (!empty($this->token)) {
            // use raw token header (matches example: 'Authorization: TOKEN')
            $headers['Authorization'] = $this->token;
        }

        // log request (mask token)
        $loggedHeaders = $headers;
        if (isset($loggedHeaders['Authorization'])) {
            $loggedHeaders['Authorization'] = self::maskToken($loggedHeaders['Authorization']);
        }
        Log::info('Fonnte multipart request', ['url' => $this->apiUrl, 'headers' => $loggedHeaders, 'body_keys' => array_keys($fields), 'file' => $filePath ? basename($filePath) : null]);

        $request = Http::withHeaders($headers);

        if ($filePath && file_exists($filePath)) {
            $stream = fopen($filePath, 'r');
            if ($stream === false) {
                throw new Exception('Cannot open file: ' . $filePath);
            }
            $request = $request->attach('file', $stream, basename($filePath));
        }

        $response = $request->post($this->apiUrl, $fields);

        Log::info('Fonnte multipart response', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->failed()) {
            throw new Exception('Fonnte multipart error: ' . $response->body());
        }

        return $response->json();
    }
}
