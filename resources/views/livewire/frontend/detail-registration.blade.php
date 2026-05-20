<div>
    <section id="ppdb-edit"
        style="margin-bottom: 30px; display: flex; align-items: center; justify-content: center; min-height: 80vh;">
        <div class="container" style="margin-top: 80px;">
            <div class="section-title text-center mt-2 mb-3">
                <div class="section-title">
                    <h2>Pendaftaran Peserta Didik Baru (PPDB)</h2>
                </div>

            </div>
            <div class="shadow-lg" style="max-width: 800px; margin: auto; border-radius: 12px;">
                @if ($student->status === 'pending')
                    <div class="alert alert-warning " role="alert">
                        Proses pendaftaran anda masih dalam proses verifikasi oleh panitia
                    </div>
                @elseif($student->status === 'verified')
                    <div class="alert alert-info " role="alert">
                        Proses pendaftaran anda sudah di verifikasi oleh panitia tunggu pengumuman selanjutnya
                    </div>
                @elseif($student->status === 'accepted')
                    <div class="alert alert-success " role="alert">
                        Berkas anda sudah di terima oleh panitia
                    </div>
                @elseif($student->status === 'rejected')
                    <div class="alert alert-danger" role="alert">
                        Mohon Maaf Berkas Anda Ditolak
                    </div>
                @endif
            </diV>
            <div class="card shadow-lg" style="max-width: 800px; margin: auto; border-radius: 12px;">
                <div class="card-header text-white bg-primary"
                    style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <h5 class="card-title text-center mb-0 py-2">Detail Data Pendaftar</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <!-- Tampilkan Foto Pendaftar -->
                        <img src="{{ $student->files && $student->files->pas_foto
                            ? asset('storage/' . $student->files->pas_foto)
                            : asset('img/no-image.jpg') }}"
                            alt="Foto Pendaftar" class="rounded-circle"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nama Lengkap:</div>
                        <div class="col-md-8">{{ $student->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $student->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nomor Telepon:</div>
                        <div class="col-md-8">{{ $student->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Alamat:</div>
                        <div class="col-md-8">{{ $student->address }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Pendaftaran:</div>
                        <div class="col-md-8">{{ \Carbon\Carbon::parse($student->registration_date)->format('d F Y') }}
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; background: #f8fafc;">

                        <div class="card-body">

                            <h5 class="fw-bold mb-4 text-primary">
                                <i class="bi bi-bar-chart-line-fill"></i>
                                Hasil Perhitungan Seleksi
                            </h5>
                            @if (!$student->status === 'accepted')
                                <div class="row g-3">

                                    <!-- Ranking -->
                                    <div class="col-md-4">
                                        <div class="p-3 bg-white shadow-sm h-100"
                                            style="border-radius: 12px; border-left: 5px solid #0d6efd;">

                                            <small class="text-muted d-block mb-1">
                                                Ranking
                                            </small>

                                            <h4 class="fw-bold mb-0 text-primary">
                                                #{{ $student->ranking ?? '-' }}
                                            </h4>

                                            <small class="text-muted">
                                                Posisi peringkat siswa
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Jarak -->
                                    <div class="col-md-4">
                                        <div class="p-3 bg-white shadow-sm h-100"
                                            style="border-radius: 12px; border-left: 5px solid #198754;">

                                            <small class="text-muted d-block mb-1">
                                                Jarak Rumah
                                            </small>

                                            <h5 class="fw-bold mb-0 text-success">
                                                {{ $student->distance_detail ?? '-' }}
                                            </h5>

                                            <small class="text-muted">
                                                Semakin dekat semakin prioritas
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Umur -->
                                    <div class="col-md-4">
                                        <div class="p-3 bg-white shadow-sm h-100"
                                            style="border-radius: 12px; border-left: 5px solid #ffc107;">

                                            <small class="text-muted d-block mb-1">
                                                Umur
                                            </small>

                                            <h5 class="fw-bold mb-0 text-warning">
                                                {{ $student->age_detail ?? '-' }}
                                            </h5>

                                            <small class="text-muted">
                                                Prioritas umur lebih tua
                                            </small>
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    Hasil Seleksi Tidak Tersedia karena berkas belum diterima panitia
                                </div>
                            @endif

                            <!-- Info Perhitungan -->
                            <div class="alert alert-light border mt-4 mb-0" style="border-radius: 12px;">

                                <small class="text-muted">
                                    <strong>Sistem Seleksi:</strong>
                                    Ranking dihitung berdasarkan
                                    <strong>jarak rumah terdekat</strong>
                                    dari sekolah dan
                                    <strong>umur siswa paling tua</strong>
                                    apabila jarak sama.
                                </small>

                            </div>

                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('user.edit', ['studentId' => strval($student->id)]) }}"
                            class="{{ $student->status === 'accepted' ? 'd-none' : '' }} btn btn-warning">Update</a>

                        <button class="btn btn-primary" wire:click="generatePdf('{{ $student->id }}')">Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
