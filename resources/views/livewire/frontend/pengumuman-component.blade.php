<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
            <h5 class="mb-0 fw-bold">
                <i class="ti ti-award me-2"></i> Peringkat Siswa Berdasarkan Jarak & Umur
            </h5>
        </div>

        <div class="card-body">
            {{-- 🔔 Pengumuman di atas tabel --}}
            <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                <i class="ti ti-megaphone me-2 fs-4"></i>
                <div>
                    <strong>Pengumuman:</strong><br>
                    Jika Anda sudah mendaftar namun nama belum muncul dalam daftar, silakan hubungi <strong>Panitia
                        PPDB</strong> untuk konfirmasi data.
                </div>
            </div>

            {{-- Info tambahan --}}
            <div class="alert alert-info mb-4">
                <i class="ti ti-info-circle me-2"></i>
                Ranking ini dihitung berdasarkan jarak rumah ke sekolah dan usia siswa.
                Jika jarak sama, siswa dengan usia lebih tua akan diprioritaskan.
            </div>

            {{-- Filter dan jumlah siswa --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="fw-semibold">Total Siswa: </span>
                    <span class="badge bg-secondary">{{ $students->total() }}</span>
                </div>
                <input type="search" wire:model.live="search" class="form-control w-50"
                    placeholder="Cari nama siswa...">
            </div>

            {{-- Tabel hasil ranking --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light text-center fw-semibold">
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Umur</th>
                            <th>Jarak ke Sekolah (meter)</th>
                            <th>Status</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                            <tr class="text-center">
                                <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                                <td class="text-start fw-semibold">{{ $student->name }}</td>
                                <td>{{ $student->calculated_age }} tahun</td>
                                <td>{{ number_format($student->distance, 2) }}</td>
                                <td>
                                    @if ($student->status === 'Diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif ($student->status === 'Cadangan')
                                        <span class="badge bg-warning text-dark">Cadangan</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $index + 1 }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted fw-semibold py-4">
                                    Data siswa belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($students->count() > 0)
                <div class="mt-3">
                    {{ $students->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
