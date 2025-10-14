<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">
            Data Siswa Berdasarkan Jarak dan Umur
        </div>

        <div class="card-body">
            <div class="col-12 d-flex justify-content-end mb-3">
                <input type="search" wire:model.live="search" placeholder="Cari siswa..." class="form-control w-50">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="fw-bold text-center bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Umur</th>
                            <th>Jarak ke Sekolah (meter)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $key => $student)
                            @php
                                $umur = $student->date_of_birth
                                    ? \Carbon\Carbon::parse($student->date_of_birth)->age
                                    : '-';
                            @endphp
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td class="text-center">
                                    {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d-m-Y') : '-' }}
                                </td>
                                <td class="text-center">{{ $umur }}</td>
                                <td class="text-center">{{ number_format($student->distance, 2) }}</td>
                                <td class="text-center">
                                    @if ($key + 1 <= 10)
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Cadangan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center fw-bold text-muted">
                                    Data siswa tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
