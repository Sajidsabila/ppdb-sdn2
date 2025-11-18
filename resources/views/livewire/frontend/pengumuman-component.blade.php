<section id="ppdb-section"
    style="margin-bottom: 30px; display: flex; align-items: center; justify-content: center; min-height: 80vh;">
    <div class="container mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">📋 Peringkat Siswa Berdasarkan Jarak dan Umur</h4>
                <span class="badge bg-light text-dark">
                    Total: {{ $students->total() }}
                </span>
            </div>

            <div class="card-body">
                {{-- Keterangan --}}
                <div class="alert alert-info mb-4" role="alert">
                    <strong>Keterangan:</strong><br>
                    <ul class="mb-0 ps-3">
                        <li>Peringkat dihitung berdasarkan <strong>jarak terdekat</strong> dari sekolah.</li>
                        <li>Jika jarak sama, maka <strong>umur tertua</strong> akan mendapatkan prioritas lebih tinggi.
                        </li>
                        <li>Status siswa:
                            <span class="badge bg-success">Diterima</span>,
                            <span class="badge bg-warning text-dark">Cadangan</span>,
                            <span class="badge bg-danger">Ditolak</span>.
                        </li>
                    </ul>
                </div>

                @if ($students->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama</th>
                                    <th style="width: 120px;">Umur</th>
                                    <th style="width: 120px;">Jarak (km)</th>
                                    <th style="width: 140px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $index => $student)
                                    <tr>
                                        <td class="fw-bold text-center">
                                            {{ $students->firstItem() + $index }}
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->calculated_age ?? '-' }} tahun</td>
                                        <td>{{ number_format($student->distance, 2) }}</td>
                                        <td>
                                            @if ($student->status == 'Diterima')
                                                <span class="badge bg-success px-3 py-2">Diterima</span>
                                            @elseif ($student->status == 'Cadangan')
                                                <span class="badge bg-warning text-dark px-3 py-2">Cadangan</span>
                                            @else
                                                <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $students->links() }}
                    </div>
                @else
                    <div class="alert alert-warning text-center">
                        <strong>Belum ada data siswa</strong> yang memiliki koordinat lokasi.
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
