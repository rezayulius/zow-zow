<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #D4A574 0%, #B8935E 100%);
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 28px;
        }

        .content {
            padding: 40px 30px;
        }

        .otp-box {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px dashed #D4A574;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }

        .otp-code {
            font-size: 48px;
            font-weight: bold;
            color: #2C1810;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }

        .message {
            color: #495057;
            line-height: 1.6;
            font-size: 16px;
        }

        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .warning p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🐾 ZowZowVetique</h1>
        </div>

        <div class="content">
            <p class="message">Halo!</p>
            <p class="message">Terima kasih telah mendaftar di ZowZowVetique. Gunakan kode OTP berikut untuk
                memverifikasi email Anda:</p>

            <div class="otp-box">
                <div class="otp-code">{{ $otp }}</div>
            </div>

            <p class="message">Masukkan kode ini pada halaman verifikasi untuk melanjutkan.</p>

            <div class="warning">
                <p><strong>⏰ Penting:</strong> Kode ini akan kadaluarsa dalam 10 menit.</p>
            </div>

            <p class="message">Jika Anda tidak melakukan pendaftaran, abaikan email ini.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} ZowZowVetique. All rights reserved.</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas.</p>
        </div>
    </div>
</body>

</html>