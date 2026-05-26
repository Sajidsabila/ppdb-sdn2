<!DOCTYPE html>
<html>

<head>
    <title>Laporan Siswa Diterima</title>

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
            margin-bottom: 20px;
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
            font-size: 12px;
        }

        hr {
            margin: 20px 0;
            border: 1px solid #000;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-text">
            <h3>Penerimaan Peserta Didik Baru (PPDB)</h3>
            <h1>{{ $configuration->name }}</h1>
            <h3>
                Tahun Pelajaran
                {{ $year->start_year ?? '-' }}/{{ $year->end_year ?? '-' }}
            </h3>
        </div>
    </div>

    <hr>

    <h2>Daftar Siswa Diterima</h2>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pendaftaran</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>Tanggal Pendaftaran</th>
                <th>Nama Orang Tua</th>
                <th>Status Berkas</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <td>{{ $student->id }}</td>

                    <td>{{ $student->name }}</td>

                    {{-- Tanggal Lahir (Indonesia) --}}
                    <td>
                        {{ $student->date_of_birth
                            ? \Carbon\Carbon::parse($student->date_of_birth)->locale('id')->translatedFormat('d F Y')
                            : '-' }}
                    </td>

                    <td>
                        {{ $student->created_at
                            ? \Carbon\Carbon::parse($student->created_at)->locale('id')->translatedFormat('d F Y')
                            : '-' }}
                    </td>

                    {{-- Orang Tua --}}
                    <td>
                        {{ $student->parents->father_name ?? 'Tidak Diketahui' }}
                    </td>

                    {{-- Status Berkas --}}
                    <td>
                        @if ($student->isFilesComplete())
                            <span style="color: green; font-weight: bold;">Lengkap</span>
                        @else
                            <span style="color: red; font-weight: bold;">Kurang Lengkap</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>



</body>

</html>
