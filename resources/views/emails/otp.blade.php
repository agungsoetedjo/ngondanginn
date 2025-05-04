<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f8fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
            font-size: 24px;
            text-align: center;
        }
        .otp-code {
            font-size: 28px;
            font-weight: bold;
            color: #28a745;
            text-align: center;
            padding: 10px;
            background-color: #e6f9e6;
            border-radius: 5px;
            margin: 20px 0;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Verifikasi Akun Anda di NgondangIn</h1>
        <p>Halo, {{ $userName }}</p>
        <p>Terima kasih telah mendaftar di NgondangIn! Untuk melanjutkan proses pendaftaran, kami memerlukan konfirmasi dari Anda.</p>
        <p>Masukkan kode OTP di bawah ini untuk memverifikasi akun Anda:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>Jangan khawatir, kode OTP ini hanya berlaku selama {{ $otpDuration }} menit.</p>
        <p>Jika Anda tidak merasa melakukan pendaftaran, abaikan email ini.</p>
        <div class="footer">
            <p>Terima kasih telah bergabung dengan NgondangIn! <br> Tim NgondangIn</p>
        </div>
    </div>
</body>
</html>
