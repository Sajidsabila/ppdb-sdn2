<div class="col-12">
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
            <span>Data Ranking Siswa PPDB</span>
        </div>

        <div class="card-body">

            {{-- FILTER --}}
            <div class="d-flex justify-content-between align-items-center mb-5 gap-3 flex-wrap">

                <div class="col-md-3">
                    <select wire:model.live="academic_year_id" class="form-select">

                        <option value="">
                            Semua Tahun Pelajaran
                        </option>

                        @foreach ($academicYears as $year)
                            <option value="{{ $year->id }}">
                                {{ $year->start_year . '/' . $year->end_year }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-3">
                    <input type="search" wire:model.live.debounce.500ms="search" placeholder="Cari nama siswa..."
                        class="form-control">
                </div>

                {{-- BUTTON ACTION --}}


            </div>

            <div class="d-flex gap-2 my-3">



                {{-- EXPORT EXCEL --}}
                <button wire:click="exportExcel" class="btn btn-outline-success">
                    <i class="ti ti-file-spreadsheet"></i>
                    Export Excel
                </button>

                {{-- EXPORT PDF --}}
                <button wire:click="exportPdf" class="btn btn-outline-danger">
                    <i class="ti ti-file-type-pdf"></i>
                    Export PDF
                </button>

            </div>

            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="table table-bordered table-striped align-middle">

                    <thead class="table-light text-center">

                        <tr>
                            <th width="5%">#</th>
                            <th>No Pendaftaran</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Lahir</th>
                            <th>Umur</th>
                            <th>Jarak Rumah</th>
                            <th>Ranking</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($students as $key => $student)
                            <tr>

                                <td class="text-center fw-bold">
                                    {{ $students->firstItem() + $key }}
                                </td>

                                <td>{{ $student->id }}</td>

                                <td>
                                    {{ $student->name }}
                                </td>

                                <td>
                                    {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->locale('id')->translatedFormat('d F Y') : '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $student->age_detail ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ $student->distance_detail ?? '-' }}
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-primary">
                                        {{ $student->ranking }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    @if ($student->status == 'Diterima')
                                        <span class="badge bg-success px-3 py-2">
                                            Diterima
                                        </span>
                                    @elseif ($student->status == 'Cadangan')
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            Cadangan
                                        </span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2">
                                            Ditolak
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center text-muted fw-bold py-4">
                                    Data siswa tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>
