@if ($order->payment && $order->payment->payment_status === 'rejected')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Ditolak - NgondangIn</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #fff5f5; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background-color: #fff; padding: 20px; border-radius: 10px; border: 1px solid #ffcdd2; }
        .header { text-align: center; background-color: #f44336; color: white; padding: 20px; border-radius: 10px 10px 0 0; }
        .header h1 { margin: 0; font-size: 22px; }
        .section { margin-top: 20px; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 10px; vertical-align: top; }
        .label { font-weight: bold; width: 40%; background-color: #ffebee; }
        .value { color: #333; }
        .footer { text-align: center; font-size: 14px; margin-top: 30px; color: #666; }
        a { color: #f44336; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .alert-box {
            background-color: #ffebee;
            border: 1px solid #ef9a9a;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            color: #c62828;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pembayaran Anda Ditolak</h1>
        </div>

        <div class="section">
            <div class="alert-box">
                Mohon maaf, pembayaran dengan kode transaksi <strong>{{ $order->kode_transaksi }}</strong> telah <strong>ditolak</strong> oleh tim kami.
                @if ($order->payment->payment_desc)
                    <br><br>Alasan: <em>{{ $order->payment->payment_desc }}</em>
                @endif
                <br><br>Silakan unggah ulang bukti pembayaran yang valid melalui halaman akun Anda.
            </div>

            <table class="info-table" style="margin-top: 20px;">
                <tr>
                    <td class="label">Nama Pemesan:</td>
                    <td class="value">{{ $order->nama_pemesan }}</td>
                </tr>
                <tr>
                    <td class="label">Waktu Pembayaran:</td>
                    <td class="value">{{ \Carbon\Carbon::parse($order->payment->created_at)->translatedFormat('l, d F Y - H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Total Pembayaran:</td>
                    <td class="value">Rp{{ number_format($order->payment->payment_total, 0, ',', '.') }}</td>
                </tr>
                @if ($order->payment->payment_proof)
                <tr>
                    <td class="label">Bukti Transfer:</td>
                    <td class="value">
                        <a href="{{ asset($order->payment->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a>
                    </td>
                </tr>
                @endif
            </table>
        </div>

        <div class="footer">
            <p>Silakan hubungi tim support jika Anda membutuhkan bantuan lebih lanjut.</p>
            <p><a href="{{ url('/') }}">Kembali ke Beranda</a></p>
        </div>
    </div>
</body>
</html>
@endif

@if ($order->payment && $order->payment->payment_status === 'paid')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran Disetujui - NgondangIn</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0fdf4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background-color: #fff; padding: 20px; border-radius: 10px; border: 1px solid #c8e6c9; }
        .header { text-align: center; background-color: #4caf50; color: white; padding: 20px; border-radius: 10px 10px 0 0; }
        .header h1 { margin: 0; font-size: 22px; }
        .section { margin-top: 20px; }
        .info-table { width: 100%; border-collapse: collapse; }
        .info-table td { padding: 10px; vertical-align: top; }
        .label { font-weight: bold; width: 40%; background-color: #f1f8e9; }
        .value { color: #333; }
        .footer { text-align: center; font-size: 14px; margin-top: 30px; color: #666; }
        a { color: #4caf50; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .success-box {
            background-color: #e8f5e9;
            border: 1px solid #a5d6a7;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pembayaran Anda Telah Disetujui</h1>
        </div>

        <div class="section">
            <div class="success-box">
                Pembayaran Anda dengan kode transaksi <strong>{{ $order->kode_transaksi }}</strong> telah berhasil diverifikasi. Terima kasih!
            </div>

            <table class="info-table" style="margin-top: 20px;">
                <tr>
                    <td class="label">Nama Pemesan:</td>
                    <td class="value">{{ $order->nama_pemesan }}</td>
                </tr>
                <tr>
                    <td class="label">Waktu Pembayaran:</td>
                    <td class="value">{{ \Carbon\Carbon::parse($order->payment->created_at)->translatedFormat('l, d F Y - H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Tujuan Pembayaran:</td>
                    <td class="value">
                        Bank: {{ $order->payment->paymentDest->bank_name ?? 'Tidak Diketahui' }}<br>
                        No Rek: {{ $order->payment->paymentDest->account_number ?? '-' }}<br>
                        Atas Nama: {{ $order->payment->paymentDest->account_name ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="label">Total Pembayaran:</td>
                    <td class="value">Rp{{ number_format($order->payment->payment_total, 0, ',', '.') }}</td>
                </tr>
                @if ($order->payment->payment_proof)
                <tr>
                    <td class="label">Bukti Transfer:</td>
                    <td class="value">
                        <a href="{{ asset($order->payment->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a>
                    </td>
                </tr>
                @endif
            </table>
        </div>

        <div class="footer">
            <p>Tim NgondangIn mengucapkan terima kasih atas kepercayaan Anda.</p>
            <p><a href="{{ url('/') }}">Kembali ke Beranda</a></p>
        </div>
    </div>
</body>
</html>
@endif

@if ($order->payment && $order->payment->payment_status === 'waiting_verify')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran Undangan - NgondangIn</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bukti Pembayaran Undangan Digital</h1>
            <p>Terima kasih telah melakukan pembayaran untuk undangan di NgondangIn!</p>
        </div>

        <div class="section">
            <h2>Informasi Pemesan</h2>
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
                    <td class="label">Template Undangan:</td>
                    <td class="value">{{ $order->wedding->template->name ?? '-' }}</td>
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
            </table>
        </div>

        <div class="section">
            <h2>Informasi Pembayaran</h2>
            <table class="details-table">
                <tr>
                    <td class="label">Waktu Pembayaran:</td>
                    <td class="value">{{ \Carbon\Carbon::parse($order->payment->created_at)->translatedFormat('l, d F Y - H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Tujuan Pembayaran:</td>
                    <td class="value">
                    @if ($order->payment && $order->payment->paymentDest)
                        Bank: {{ $order->payment->paymentDest->bank_name ?? 'Tidak Diketahui' }} <br>
                        No Rekening: {{ $order->payment->paymentDest->account_number ?? 'Tidak Diketahui' }} <br>
                        Atas Nama: {{ $order->payment->paymentDest->account_name ?? 'Tidak Diketahui' }}
                    @else
                        Tidak Diketahui
                    @endif
                    </td>
                </tr>
                <tr>
                    <td class="label">Status Pembayaran:</td>
                    <td class="value" 
                    style="background-color: 
                        {{ 
                            $order->payment->payment_status === 'pending' || $order->payment->payment_status === 'rejected' ? '#ff4444' :
                            ($order->payment->payment_status === 'waiting_verify' ? '#ffcc00' :
                            ($order->payment->payment_status === 'paid' ? '#4caf50' : '#6c757d'))
                        }}"><x-payment-badge-status :payment_status="$order->payment->payment_status" />
                    </td>
                </tr>
                <tr>
                    <td class="label">Deskripsi Pembayaran:</td>
                    <td class="value">{{ $order->payment->payment_desc ?? 'Tidak ada deskripsi' }}</td>
                </tr>
                @if ($order->payment->payment_proof)
                    <tr>
                        <td class="label">Bukti Pembayaran:</td>
                        <td class="value">
                            <a href="{{ asset($order->payment->payment_proof) }}" target="_blank">Lihat Bukti Pembayaran</a>
                        </td>
                    </tr>
                @endif
                <tr class="total">
                    <td class="label">Total Pembayaran:</td>
                    <td class="value">Rp{{ number_format($order->payment->payment_total, 0, ',', '.') }}</td>
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
@endif