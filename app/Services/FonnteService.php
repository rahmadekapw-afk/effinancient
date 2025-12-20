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
        
        $this->apiUrl = config('services.fonnte.url') ?? '';
        $this->token  = config('services.fonnte.token') ?? null;
    }

  

    private static function maskToken(string $value): string
    {
      
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
            $headers['Authorization'] = $this->token;
        }
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
