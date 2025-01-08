@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
<div>
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
                    Form Pendaftaran Siswa
                </div>
                <div class="card-body">
                    <form id="multiStepForm" wire:submit="save">
                        @csrf

                        @if ($currentPage === 1)
                            <div class="form-step" id="step1">
                                <h5 class="mb-3 fw-bold">Data Siswa</h5>
                                <hr class="bg-primary my-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="fw-bold">Nama Lengkap</label>
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Masukkan nama lengkap" wire:model="name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="gender" class="fw-bold">Jenis Kelamin</label>
                                            <select id="gender" name="gender"
                                                class="form-control @error('gender') is-invalid @enderror"
                                                wire:model="gender">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki - laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="religion" class="fw-bold">Agama</label>
                                            <select id="religion" name="religion"
                                                class="form-control @error('religion') is-invalid @enderror"
                                                wire:model="religion">
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                            @error('religion')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="number_of_siblings" class="fw-bold">Jumlah Saudara</label>
                                            <input type="number"
                                                class="form-control @error('number_of_siblings') is-invalid @enderror"
                                                placeholder="Masukkan jumlah saudara" wire:model="number_of_siblings">
                                            @error('number_of_siblings')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email" class="fw-bold">Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukkan Email" wire:model="email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address" class="fw-bold">Alamat</label>
                                            <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Masukkan alamat lengkap" wire:model="address"></textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="place_of_birth" class="fw-bold">Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('place_of_birth') is-invalid @enderror"
                                                placeholder="Masukkan tempat lahir" wire:model="place_of_birth">
                                            @error('place_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="date_of_birth" class="fw-bold">Tanggal Lahir</label>
                                            <input type="date"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                wire:model="date_of_birth">
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nik" class="fw-bold">NIK</label>
                                            <input type="text"
                                                class="form-control @error('nik') is-invalid @enderror"
                                                placeholder="Masukkan NIK" wire:model="nik">
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="child_order" class="fw-bold">Status Dalam Keluarga</label>
                                            <input type="text"
                                                class="form-control @error('child_order') is-invalid @enderror"
                                                placeholder="Masukkan status dalam keluarga" wire:model="child_order">
                                            @error('child_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone" class="fw-bold">NOmer Telepon</label>
                                            <input type="number"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Masukkan NOmer Telepon" wire:model="phone">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($currentPage === 2)
                            <div class="form-step" id="step2">
                                <h5 class="mb-3 fw-bold">Data Orang Tua</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="father_name" class="fw-bold">Nama Ayah</label>
                                            <input type="text" id="father_name" name="father_name"
                                                class="form-control @error('father_name') is-invalid @enderror"
                                                placeholder="Masukkan nama ayah" wire:model="father_name">
                                            @error('father_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="father_education" class="fw-bold">Pendidikan Ayah</label>
                                            <select id="father_education" name="father_education"
                                                class="form-control @error('father_education') is-invalid @enderror"
                                                wire:model="father_education">
                                                <option value="">Pilih pendidikan ayah</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Magister">Magister</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('father_education')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="father_occupation" class="fw-bold">Pekerjaan Ayah</label>
                                            <select id="father_occupation" name="father_occupation"
                                                class="form-control @error('father_occupation') is-invalid @enderror"
                                                wire:model="father_occupation">
                                                <option value="" selected disabled>Pilih pekerjaan ayah</option>
                                                <option value="Tidak Bekerja">Tidak Bekerja</option>
                                                <option value="Pegawai Negeri Sipil (PNS)">Pegawai Negeri Sipil (PNS)
                                                </option>
                                                <option value="Guru">Guru</option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Perawat">Perawat</option>
                                                <option value="Pengusaha">Pengusaha</option>
                                                <option value="Petani">Petani</option>
                                                <option value="Nelayan">Nelayan</option>
                                                <option value="Pedagang">Pedagang</option>
                                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                <option value="Buruh">Buruh</option>
                                                <option value="Sopir">Sopir</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('father_occupation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="mother_name" class="fw-bold">Nama Ibu</label>
                                            <input type="text" id="mother_name" name="mother_name"
                                                class="form-control @error('mother_name') is-invalid @enderror"
                                                placeholder="Masukkan nama ibu" wire:model="mother_name">
                                            @error('mother_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="mother_education" class="fw-bold">Pendidikan Ibu</label>
                                            <select id="mother_education" name="mother_education"
                                                class="form-control js-example-basic-multiple @error('mother_education') is-invalid @enderror"
                                                wire:model="mother_education">
                                                <option value="">Pilih pendidikan ibu</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Magister">Magister</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('mother_education')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="mother_occupation" class="fw-bold">Pekerjaan Ibu</label>
                                            <select id="mother_occupation" name="mother_occupation"
                                                class="form-control js-example-basic-single @error('mother_occupation') is-invalid @enderror"
                                                wire:model="mother_occupation">
                                                <option value="" selected disabled>Pilih pekerjaan ibu
                                                </option>
                                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                                <option value="Pegawai Negeri Sipil (PNS)">Pegawai Negeri Sipil
                                                    (PNS)</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Perawat">Perawat</option>
                                                <option value="Pengusaha">Pengusaha</option>
                                                <option value="Petani">Petani</option>
                                                <option value="Nelayan">Nelayan</option>
                                                <option value="Pedagang">Pedagang</option>
                                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                                <option value="Buruh">Buruh</option>
                                                <option value="Sopir">Sopir</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                            @error('mother_occupation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        @error('mother_occupation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @elseif($currentPage === 3)
                            <div class="form-step" id="step3">
                                <h5 class="mb-3 fw-bold">Berkas Pendaftaran</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Pas Foto -->
                                        <div class="form-group mb-3">
                                            <label for="pas_foto" class="fw-bold">Pas Foto</label>
                                            <input type="file" id="pas_foto"
                                                class="form-control @error('pas_foto') is-invalid @enderror"
                                                wire:model="pas_foto" wire:loading.attr="disabled">
                                            @error('pas_foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <!-- Preview Pas Foto -->
                                            @if (is_object($pas_foto))
                                                <div class="mt-2">
                                                    <img src="{{ $pas_foto->temporaryUrl() }}" alt="Preview Pas Foto"
                                                        class="img-fluid" width="150">
                                                </div>
                                            @elseif($pas_foto)
                                                <img src="{{ $pas_foto }}" alt="Preview Pas Foto"
                                                    class="img-fluid" width="150">
                                            @endif
                                        </div>

                                        <!-- Akte Kelahiran -->
                                        <div class="form-group mb-3">
                                            <label for="akte_kelahiran" class="fw-bold">Akte Kelahiran</label>
                                            <input type="file" id="akte_kelahiran"
                                                class="form-control @error('akte_kelahiran') is-invalid @enderror"
                                                wire:model="akte_kelahiran">
                                            @error('akte_kelahiran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if ($akte_kelahiran)
                                                <div class="mt-2">
                                                    <iframe src="{{ $akte_kelahiran }}" frameborder="0"
                                                        style="width: 100%; height: 300px;" allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Kartu Keluarga -->
                                        <div class="form-group mb-3">
                                            <label for="kartu_keluarga" class="fw-bold">Kartu Keluarga</label>
                                            <input type="file" id="kartu_keluarga"
                                                class="form-control @error('kartu_keluarga') is-invalid @enderror"
                                                wire:model="kartu_keluarga">
                                            @error('kartu_keluarga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if ($kartu_keluarga)
                                                <div class="mt-2">
                                                    <iframe src="{{ $kartu_keluarga }}" frameborder="0"
                                                        style="width: 100%; height: 300px;" allowfullscreen>
                                                    </iframe>
                                                </div>
                                            @elseif(is_object($kartu_keluarga))
                                                <iframe src="{{ $kartu_keluarga->temporaryUrl() }}" frameborder="0"
                                                    style="width: 100%; height: 300px;" allowfullscreen>
                                                </iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endif
                        @if ($currentPage === 1)
                            <a href="{{ route('admin.ppdb') }}" class="btn btn-secondary">Kembali</a>
                        @endif
                        @if ($currentPage > 1)
                            <button type="button" wire:click="previousPage"
                                class="btn btn-secondary">Previous</button>
                        @endif

                        @if ($currentPage < $totalPages)
                            <button type="button" wire:click="nextPage" class="btn btn-primary">Next</button>
                        @endif

                        @if ($currentPage === $totalPages)
                            <!-- Tombol Submit ketika sudah di halaman terakhir -->
                            <button type="submit" class="btn btn-success">Submit</button>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
