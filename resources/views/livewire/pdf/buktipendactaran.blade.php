<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            background-color: #fff;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        .header-text h3 {
            margin: 5px 0;
            font-size: 18px;
        }

        hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 20px 0;
        }

        .content h4 {
            text-align: center;
            margin-bottom: 15px;
            text-decoration: underline;
            font-size: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        table td:first-child {
            width: 30%;
            font-weight: bold;
        }

        .footer {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('storage/' . $configuration->logo ?? 'image.jpg') }}" alt="Logo" class="logo">

            <div class="header-text">
                <h3>Penerimaan Peserta Didik Baru (PPDB)</h3>
                <h3>{{ $configuration->name }}</h3>
                <h3>Jalur Mandiri Online</h3>
                <h3>Tahun Pelajaran
                    {{ $student->year?->start_year ?? 'Tahun Tidak Ada' }}/{{ $student->year?->end_year ?? 'Tahun Tidak Ada' }}
                </h3>
            </div>
        </div>

        <hr>

        <div class="content">
            <h4>Bukti Pendaftaran PPDB</h4>
            <p>Calon siswa yang tercantum di bawah ini:</p>
            <table>
                <tr>
                    <td>Nomor Peserta</td>
                    <td>{{ $student->id }}</td>
                </tr>
                <tr>
                    <td>Nama Siswa</td>
                    <td>{{ $student->name }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>{{ $student->gender }}</td>
                </tr>
                <tr>
                    <td>Tempat Lahir</td>
                    <td>{{ $student->place_of_birth }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->isoFormat('D MMMM YYYY') }}</td>
                </tr>
            </table>
            <p>Pada Tanggal: {{ \Carbon\Carbon::parse($student->created_at)->isoFormat('D MMMM YYYY HH:mm:ss') }}
                dinyatakan telah sukses melakukan pendaftaran.</p>
        </div>

        <div class="footer">
            <p><strong>Note:</strong></p>
            <p>Harap simpan bukti pendaftaran ini sebagai bukti yang sah.</p>
        </div>
    </div>
</body>

</html>
