<!DOCTYPE html>
<html>

<head>
    <title>Laporan Ranking Siswa</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 20px;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            font-family: 'Roboto', sans-serif;
        }

        .header {
            margin-bottom: 30px;
            text-align: center;
        }

        .header-text h3 {
            margin: 5px;
            font-weight: 500;
            font-size: 18px;
        }

        .header-text h1 {
            font-size: 24px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            font-family: 'Roboto', sans-serif;
        }

        hr {
            margin: 20px 0;
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    <!-- Header Section (Kop Surat) -->
    <div class="header">
        <div class="header-text">
            <h3>Penerimaan Peserta Didik Baru (PPDB)</h3>

            <h1>{{ $configuration->name }}</h1>

            <h3>
                Tahun Pelajaran
                {{ $academic->start_year ?? 'Tahun Tidak Ada' }}/{{ $academic->end_year ?? 'Tahun Tidak Ada' }}
            </h3>
        </div>
    </div>

    <hr>

    <h2>Daftar Ranking Siswa</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ranking</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>Jarak Rumah</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td class="text-center">
                        {{ $index + 1 }}
                    </td>

                    <td class="text-center">
                        {{ $student->ranking ?? '-' }}
                    </td>

                    <td>
                        {{ $student->name }}
                    </td>

                    <td>
                        {{ $student->date_of_birth
                            ? \Carbon\Carbon::parse($student->date_of_birth)->locale('id')->translatedFormat('d F Y')
                            : '-' }}
                    </td>

                    <td>
                        {{ $student->age_detail ?? '-' }}
                    </td>

                    <td>
                        {{ $student->distance_detail ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ $student->status ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
