<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappController extends Controller
{
    public function send(Request $request)
    {
        // Normalisasi nomor WhatsApp
        $number = preg_replace('/[^0-9\+]/', '', $request->input('number'));
        if (substr($number, 0, 3) === '+62') {
            $number = '62' . substr($number, 3);
        }
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // Siapkan data
        $nama = $request->input('name');
        $message = $request->input('message');
        // Kirim ke Fonnte API
        $response = Http::asForm()->withHeaders([
            'Authorization' => env('WHATSAPP_KEY'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $number,
            'message' => $message,
            'countryCode' => '62',
        ]);

        // Jika sukses
        if ($response->successful()) {
            return response()->json(['success' => true, 'nomor' => $number, 'message' => 'Pesan berhasil dikirim']);
        } else {
            return response()->json(['success' => false, 'error' => $response->body()], 500);
        }
    }
}
