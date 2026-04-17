<section id="ppdb-section"
    style="margin-top: 130px; margin-bottom: 30px; display: flex; align-items: center; justify-content: center; min-height: 80vh;">

    <div class="container mt-3">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

                <h4 class="mb-0">📋 Peringkat Siswa Berdasarkan Jarak dan Umur</h4>

                {{-- TOTAL --}}
                <span class="badge bg-light text-dark">
                    Total: {{ $total }}
                </span>

            </div>

            <div class="card-body">

                {{-- SEARCH --}}
                <div class="mb-3">
                    <input type="text" class="form-control w-50" placeholder="Cari nama siswa..."
                        wire:model.live="search">
                </div>

                {{-- KETERANGAN --}}
                <div class="alert alert-info mb-4">
                    <strong>Keterangan:</strong><br>
                    <ul class="mb-0 ps-3">
                        <li>Peringkat berdasarkan <b>jarak terdekat</b>.</li>
                        <li>Jika sama → <b>umur tertua prioritas</b>.</li>
                        <li>Status:
                            <span class="badge bg-success">Diterima</span>
                            <span class="badge bg-warning text-dark">Cadangan</span>
                            <span class="badge bg-danger">Ditolak</span>
                        </li>
                    </ul>
                </div>

                {{-- TABLE --}}
                @if (count($students) > 0)

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Umur</th>
                                    <th>Jarak</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($students as $index => $student)
                                    <tr>

                                        {{-- NO --}}
                                        <td class="fw-bold text-center">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>{{ $student->name }}</td>

                                        <td>{{ $student->age_detail ?? '-' }}</td>

                                        <td>
                                            @php
                                                $km = floor($student->distance);
                                                $meter = round(($student->distance - $km) * 1000);
                                            @endphp

                                            {{ $km > 0 ? "$km Km $meter Meter" : "$meter Meter" }}
                                        </td>

                                        <td>
                                            @if ($student->status == 'Diterima')
                                                <span class="badge bg-success">Diterima</span>
                                            @elseif ($student->status == 'Cadangan')
                                                <span class="badge bg-warning text-dark">Cadangan</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    {{-- LOAD MORE BUTTON --}}
                    @if (count($students) < $total)
                        <div class="text-center mt-3">
                            <button class="btn btn-primary" wire:click="loadMore">
                                Load More
                            </button>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning text-center">
                        Belum ada data siswa
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>
