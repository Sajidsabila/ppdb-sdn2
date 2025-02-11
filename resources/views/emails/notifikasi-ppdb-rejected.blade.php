<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888;
            background-color: #f9f9f9;
            border-top: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>PPDB SDN Purwosari 2</h1>
        </div>
        <div class="content">
            <p>Mohon maaf, pendaftaran dengan ID <strong>{{ $id }}</strong> tidak dapat kami terima di
                <strong>SDN Purwosari 2</strong>.</p>
            <p>Kami mengucapkan terima kasih atas minat Anda untuk mendaftar di SDN Purwosari 2. Jika Anda membutuhkan
                informasi lebih lanjut atau ingin mengajukan pertanyaan, silakan hubungi kami melalui email ini atau
                kunjungi website resmi kami.</p>

            <a href="https://www.sdn-purwosari2.sch.id" class="btn">Kunjungi Website</a>
        </div>
        <div class="footer">
            <p>&copy; 2025 SDN Purwosari 2. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
