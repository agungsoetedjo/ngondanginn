<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

function sendWhatsAppNotification(string $number, string $message): void
    {
        // Normalisasi nomor WA
        $number = preg_replace('/[^0-9\+]/', '', $number);
        if (substr($number, 0, 3) === '+62') {
            $number = '62' . substr($number, 3);
        } elseif (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        try {
            Http::asForm()->withHeaders([
                'Authorization' => env('WHATSAPP_KEY'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $number,
                'message' => $message,
                'countryCode' => '62',
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal kirim WhatsApp: ' . $e->getMessage());
        }
    }