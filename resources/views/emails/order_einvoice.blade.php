<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pemesanan Undangan - NgondangIn</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        .container { width: 100%; max-width: 600px; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .header { background-color: #4CAF50; color: white; padding: 15px; text-align: center; border-radius: 10px 10px 0 0; }
        .header h1 { margin: 0; font-size: 24px; }
        .section { margin-top: 20px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px; }
        .section h2 { font-size: 18px; color: #333; margin-bottom: 10px; border-bottom: 2px solid #4CAF50; padding-bottom: 5px; }
        .details { margin-top: 10px; font-size: 16px; color: #555; }
        .details p { margin: 5px 0; }
        .details .label { font-weight: bold; color: #333; }
        .footer { text-align: center; font-size: 14px; margin-top: 20px; color: #888; }
        .footer a { color: #4CAF50; text-decoration: none; }
        .footer a:hover { text-decoration: underline; }
        .border-top { border-top: 1px solid #f0f0f0; margin-top: 20px; padding-top: 10px; }
        /* Additional Styling for Table Layout */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .details-table td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        .details-table .label {
            font-weight: bold;
            width: 40%;
            background-color: #f9f9f9;
        }
        .details-table .value {
            color: #555;
        }
        .details-table .total {
            font-size: 16px;
            font-weight: bold;
            background-color: #e8f5e9;
            border-top: 2px solid #4CAF50;
        }
        .custom-badge {
            background-color: #28a745; /* Hijau sukses */
            color: #fff;
            padding: 3px 6px;
            font-size: 12px;
            border-radius: 5px;
            font-weight: 500;
            display: inline-block;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .custom-badge:hover {
            background-color: #218838;
            text-decoration: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        @php
            $status = $order->status;
            $statusText = ucfirst($status);
            $headerTitle = 'Bukti Pemesanan Undangan Digital';
            $headerSubtitle = 'Terima kasih telah memesan undangan di NgondangIn!';

            if ($status === 'processed') {
                $headerTitle = 'Undangan Anda Sedang Diproses';
                $headerSubtitle = 'Tim kami sedang menyiapkan undangan digital Anda.';
            } elseif ($status === 'published') {
                $headerTitle = 'Undangan Digital Telah Dipublikasikan';
                $headerSubtitle = 'Undangan Anda sudah aktif dan siap dibagikan.';
            } elseif ($status === 'completed') {
                $headerTitle = 'Undangan Telah Selesai';
                $headerSubtitle = 'Terima kasih telah menggunakan layanan NgondangIn!';
            }
        @endphp

        <div class="header">
            <h1>{{ $headerTitle }}</h1>
            <p>{{ $headerSubtitle }}</p>
        </div>

        <div class="section">
            <h2>Informasi Pemesanan</h2>
            <table class="details-table">
                <tr>
                    <td class="label">Kode Transaksi:</td>
                    <td class="value">{{ $order->kode_transaksi }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Pemesan:</td>
                    <td class="value">{{ $order->nama_pemesan }}</td>
                </tr>
                <tr>
                    <td class="label">No. HP:</td>
                    <td class="value">{{ $order->phone_number }}</td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td class="value">{{ $order->email_pemesan }}</td>
                </tr>
                <tr>
                    <td class="label">Status Pemesanan:</td>
                    <td class="value">
                        @php
                            $status = $order->status;
                            $statusColor = [
                                'created' => '$43a047',
                                'processed' => '#1e88e5',   // biru
                                'published' => '#fb8c00',   // oranye
                                'completed' => '#43a047',   // hijau tua
                            ];
                            $color = $statusColor[$status] ?? '#333';
                        @endphp
                        <strong style="color: {{ $color }}"><x-order-badge-status :status="$order->status" /></strong>
                    </td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Detail Undangan</h2>
            <table class="details-table">
                <tr>
                    <td class="label">Nama Mempelai:</td>
                    <td class="value">{{ $order->wedding->groom_name }} & {{ $order->wedding->bride_name }}</td>
                </tr>
                <tr>
                    <td class="label">Orangtua Mempelai Pria:</td>
                    <td class="value">{{ $order->wedding->groom_parents_info }}</td>
                </tr>
                <tr>
                    <td class="label">Orangtua Mempelai Wanita:</td>
                    <td class="value">{{ $order->wedding->bride_parents_info }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Akad:</td>
                    <td class="value">{{ \Carbon\Carbon::parse($order->wedding->akad_date)->translatedFormat('l, d F Y - H:i') ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tempat Akad:</td>
                    <td class="value">{{ $order->wedding->akad_place_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Alamat Akad:</td>
                    <td class="value">{{ $order->wedding->akad_location ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Resepsi:</td>
                    <td class="value">{{ \Carbon\Carbon::parse($order->wedding->reception_date)->translatedFormat('l, d F Y - H:i') ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Tempat Resepsi:</td>
                    <td class="value">{{ $order->wedding->reception_place_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Alamat Resepsi:</td>
                    <td class="value">{{ $order->wedding->reception_location ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Template Undangan:</td>
                    <td class="value">{{ $order->wedding->template->name ?? '-' }} {{ $order->wedding->template->category->type == 'dengan_foto' ? 'Dengan Foto' : 'Tanpa Foto' }}</td>
                </tr>
                <tr>
                    <td class="label">Musik Latar:</td>
                    <td class="value">
                        @if ($order->wedding?->music)
                            {{ $order->wedding->music->title }} - {{ $order->wedding->music->artist }}
                        @else
                            Tidak dipilih
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Kisah Cinta:</td>
                    <td class="value">{{ $order->wedding->description ?? '-' }}</td>
                </tr>
                @if (in_array($order->status, ['published', 'completed']))
                <tr>
                    <td class="label">Link Undangan:</td>
                    <td class="value" style="text-align: center;">
                        <a href="{{ route('wedding.checks', $order->wedding->slug) }}" target="_blank">
                            <span class="custom-badge">{{ $order->wedding->slug }}</span>
                        </a>
                    </td>
                </tr>
                @endif
                <tr class="total">
                    <td class="label">Total Pembayaran:</td>
                    <td class="value">Rp{{ number_format($order->wedding->template->price, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="section border-top">
            <p>Jika ada pertanyaan lebih lanjut, silakan hubungi tim kami.</p>
        </div>

        <div class="footer">
            <p>Terima kasih atas kepercayaan Anda.</p>
            <p>Tim NgondangIn</p>
            <p><a href="{{ url('/') }}">Kunjungi Website Kami</a></p>
        </div>
    </div>
</body>
</html>
