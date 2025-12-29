<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Notifikasi extends Model
{
    public $table = 'notifikasis';
    public $primaryKey = 'notifikasi_id';
    public $fillable = [
        'admin_id',
        'anggota_id',
        'judul',
        'isi',
        'tanggal',
        'created_at',
        'updated_at',
        'is_admin_read'
    ];

    protected $casts = [
        'is_admin_read' => 'boolean',
    ];

    protected static function booted()
    {
        // When a Notifikasi is created, attempt to send via Fonnte immediately.
        static::created(function (self $notifikasi) {
            try {
                $key = 'notifikasi_sent_' . $notifikasi->notifikasi_id;
                // only proceed if this key did not exist (prevents duplicate sends)
                if (! Cache::add($key, true, now()->addMinutes(10))) {
                    return;
                }
                $anggota = \App\Models\Anggota::where('anggota_id', $notifikasi->anggota_id)->first();
                if (! $anggota || empty($anggota->no_hp)) {
                    return;
                }

                $phone = preg_replace('/[^0-9]/', '', $anggota->no_hp);
                if (substr($phone, 0, 1) === '0') {
                    $phone = '62' . substr($phone, 1);
                }

                $message = trim(($notifikasi->judul ?? '') . "\n\n" . ($notifikasi->isi ?? ''));

                $service = app(\App\Services\FonnteService::class);
                $fields = [
                    'target' => $phone,
                    'message' => $message,
                    'countryCode' => '62',
                ];
                $resp = $service->sendMultipart($fields);
                \Illuminate\Support\Facades\Log::info('Auto WA sent (model event)', ['notifikasi_id' => $notifikasi->notifikasi_id, 'to' => $phone, 'response' => $resp]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('Auto WA send failed (model event): ' . $e->getMessage(), ['notifikasi_id' => $notifikasi->notifikasi_id]);
            }
        });
    }
}
