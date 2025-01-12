<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #007bff;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .button {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .footer {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Verifikasi Email Anda</h1>
        </div>
        <div class="content">
            <p>Halo {{ $user->email }},</p>
            <p>Anda telah meminta untuk mereset password Anda. Silakan klik tombol di bawah ini untuk mengatur ulang
                password Anda:</p>
            <p style="text-align: center;">
                <a href="{{ $url }}" target="_blank" class="button">Reset Password</a>
            </p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Aplikasi Kami. Semua hak dilindungi.</p>
        </div>
    </div>
</body>

</html>
