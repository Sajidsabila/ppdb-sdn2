@include('sweetalert::alert')

<div class="col-12">
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-10">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('success'))
                <div class="alert alert-success fw-bold alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header fw-bold bg-primary text-white">
                    Detail Pendaftaran Siswa
                </div>
                <div class="card-body">
                    <div class="form-step">
                        <!-- Step 1: Data Siswa -->
                        <h5 class="mb-3 fw-bold">Data Siswa</h5>
                        <hr class="bg-primary my-2">
                        <div class="row">
                            <!-- Column 1 - Left side (Image and Data) -->
                            <div class="col-md-4 d-flex justify-content-center">
                                <div class="form-group mb-3">
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $student->files->pas_foto) }}"
                                            alt="Preview Pas Foto" class="img-fluid rounded-circle shadow-lg"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- Column 2 - Right side (Form Data) -->
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label for="name" class="fw-bold">Nama Lengkap</label>
                                    <p>{{ $student->name }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gender" class="fw-bold">Jenis Kelamin</label>
                                    <p>{{ $student->gender }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="religion" class="fw-bold">Agama</label>
                                    <p>{{ $student->religion }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="number_of_siblings" class="fw-bold">Jumlah Saudara</label>
                                    <p>{{ $student->number_of_siblings }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="fw-bold">Email</label>
                                    <p>{{ $student->email }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="fw-bold">Alamat</label>
                                    <p>{{ $student->address }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Data Orang Tua -->
                        <h5 class="mb-3 fw-bold">Data Orang Tua</h5>
                        <hr class="bg-primary my-2">
                        <div class="row">
                            <!-- Column 1 - Left side (Father) -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="father_name" class="fw-bold">Nama Ayah</label>
                                    <p>{{ $student->parents->father_name }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="father_education" class="fw-bold">Pendidikan Ayah</label>
                                    <p>{{ $student->parents->father_education }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="father_occupation" class="fw-bold">Pekerjaan Ayah</label>
                                    <p>{{ $student->parents->father_occupation }}</p>
                                </div>
                            </div>

                            <!-- Column 2 - Right side (Mother) -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="mother_name" class="fw-bold">Nama Ibu</label>
                                    <p>{{ $student->parents->mother_name }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mother_education" class="fw-bold">Pendidikan Ibu</label>
                                    <p>{{ $student->parents->mother_education }}</p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="mother_occupation" class="fw-bold">Pekerjaan Ibu</label>
                                    <p>{{ $student->parents->mother_occupation }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Berkas Pendaftaran -->
                        <h5 class="mb-3 fw-bold">Berkas Pendaftaran</h5>
                        <hr class="bg-primary my-2">

                        <div class="row">
                            <!-- Akte Kelahiran -->
                            <div class="form-group mb-3">
                                <label for="akte_kelahiran" class="fw-bold">Akte Kelahiran</label>
                                <div class="mt-2">
                                    @if ($student->files->akte_kelahiran)
                                        <iframe src="{{ asset('storage/' . $student->files->akte_kelahiran) }}"
                                            frameborder="0" style="width: 100%; height: 300px;"
                                            allowfullscreen></iframe>
                                    @else
                                        <p class="text-warning">Berkas Akte Kelahiran belum diupload</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Kartu Keluarga -->
                            <div class="form-group mb-3">
                                <label for="kartu_keluarga" class="fw-bold">Kartu Keluarga</label>
                                <div class="mt-2">
                                    @if ($student->files->kartu_keluarga)
                                        <iframe src="{{ asset('storage/' . $student->files->kartu_keluarga) }}"
                                            frameborder="0" style="width: 100%; height: 300px;"
                                            allowfullscreen></iframe>
                                    @else
                                        <p class="text-warning">Berkas Kartu Keluarga belum diupload</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{ route('admin.ppdb') }}" wire:navigate>Kembali</a>
                </div>

            </div>

        </div>

    </div>

</div>
