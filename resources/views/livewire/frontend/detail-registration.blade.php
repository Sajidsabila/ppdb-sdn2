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
                        Selamat anda diterima sebagai siswa SDN Purwosari 2
                    </div>
                @elseif($student->status === 'rejected')
                    <div class="alert alert-danger" role="alert">
                        Mohon Maaf status pendaftaran anda ditolak
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
                        <img src="{{ asset('storage/' . $student->files->pas_foto) }}" alt="Foto Pendaftar"
                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
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
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status Pendaftaran</div>
                        <div class="col-md-8">
                            @if ($student->status === 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($student->status === 'verified')
                                <span class="badge bg-info text-dark">Terverifikasi</span>
                            @elseif($student->status === 'accepted')
                                <span class="badge bg-success text-white">Diterima</span>
                            @elseif($student->status === 'rejected')
                                <span class="badge bg-danger text-white">Ditolak</span>
                            @endif
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
