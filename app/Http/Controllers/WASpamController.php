<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WASpamController extends Controller
{
    public function eksekusi()
    {
        $data = [
            [
                'nama' => 'Agung Soetedjo',
                'phone_number' => '082215148544',
                'wedding' => [
                    'groom_name' => 'Agung',
                    'bride_name' => 'Sari',
                ],
                'kode_transaksi' => 'TRX123456',
            ],
            [
                'nama' => 'Budi Santoso',
                'phone_number' => '081234567890',
                'wedding' => [
                    'groom_name' => 'Budi',
                    'bride_name' => 'Ani',
                ],
                'kode_transaksi' => 'TRX654321',
            ],
        ];

        foreach ($data as $order) {
            $message = "Hai, *{$order['wedding']['groom_name']} & {$order['wedding']['bride_name']}*!\n\n" .
                "Pesanan undangan digitalmu dengan kode *#{$order['kode_transaksi']}* sudah berhasil diproses oleh tim kami.\n\n" .
                "Tunggu notifikasi selanjutnya ketika undanganmu siap untuk dipublikasikan ya!.\n\nTerimakasih.";

            $this->sendWhatsAppNotification($order['phone_number'], $message);
        }
    }

    private function sendWhatsAppNotification(string $number, string $message)
    {
        // Normalisasi nomor WA
        $number = preg_replace('/[^0-9\+]/', '', $number);
        if (substr($number, 0, 3) === '+62') {
            $number = '62' . substr($number, 3);
        } elseif (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        $payload = [
            'target' => $number,
            'message' => $message,
            'countryCode' => '62',
        ];

        try {
            Http::asForm()->withHeaders([
                'Authorization' => env('WHATSAPP_KEY'),
            ])->post('https://api.fonnte.com/send', $payload);

            Log::info("WhatsApp sent to {$number}");
        } catch (\Exception $e) {
            Log::error('Gagal kirim WhatsApp: ' . $e->getMessage());
        }
    }
}