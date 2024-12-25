<div>
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header fw-bold bg-primary text-white">
                    Form Pendaftaran Siswa
                </div>
                <div class="card-body">
                    <form id="multiStepForm" wire:submit="save" method="POST">
                        @csrf

                        @if ($currentPage === 1)
                            <div class="form-step" id="step1">
                                <h5 class="mb-3 fw-bold">Data Siswa</h5>
                                <hr class="bg-primary my-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="fw-bold">Nama Lengkap</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Masukkan nama lengkap" wire:model="name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="gender" class="fw-bold">Jenis Kelamin</label>
                                            <select id="gender" name="gender" class="form-control"
                                                wire:model="gender">
                                                <option value="Laki - laki">Laki - laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="religion" class="fw-bold">Agama</label>
                                            <select id="religion" name="religion" class="form-control"
                                                wire:model="religion">
                                                <option value="" disabled selected>Pilih Agama</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen">Kristen</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="number_of_siblings" class="fw-bold">Jumlah Saudara</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan jumlah saudara" wire:model="number_of_siblings">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email" class="fw-bold">Email</label>
                                            <input type="email" wire:model="email" class="form-control"
                                                placeholder="Masukkan Email">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address" class="fw-bold">Alamat Domisili</label>
                                            <textarea class="form-control" placeholder="Masukkan Alamat Lengkap" wire:model="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="place_of_birth" class="fw-bold">Tempat Lahir</label>
                                            <input type="text" id="place_of_birth" name="place_of_birth"
                                                class="form-control" placeholder="Masukkan tempat lahir"
                                                wire:model="place_of_birth">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="date_of_birth" class="fw-bold">Tanggal Lahir</label>
                                            <input type="date" id="date_of_birth" name="date_of_birth"
                                                class="form-control" wire:model="date_of_birth">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="nik" class="fw-bold">NIK</label>
                                            <input type="text" id="nik" name="nik" class="form-control"
                                                placeholder="Masukkan NIK" wire:model="nik">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="child_order" class="fw-bold">Status Dalam Keluarga</label>
                                            <input type="text" id="child_order" name="child_order"
                                                class="form-control" placeholder="Masukkan status dalam keluarga"
                                                wire:model="child_order">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone" class="fw-bold">Nomer Telepon</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan Nomer Telepon" wire:model="phone">
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
                                                class="form-control" placeholder="Masukkan nama ayah"
                                                wire:model="father_name">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="father_education" class="fw-bold">Pendidikan Ayah</label>
                                            <select id="father_education" name="father_education"
                                                class="form-control" wire:model="father_education">
                                                <option value="">Pilih pendidikan ayah</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Magister">Magister</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="father_occupation" class="fw-bold">Pekerjaan Ayah</label>
                                            <input type="text" id="father_occupation" name="father_occupation"
                                                class="form-control" placeholder="Masukkan pekerjaan ayah"
                                                wire:model="father_occupation">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="mother_name" class="fw-bold">Nama Ibu</label>
                                            <input type="text" id="mother_name" name="mother_name"
                                                class="form-control" placeholder="Masukkan nama ibu"
                                                wire:model="mother_name">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="mother_education" class="fw-bold">Pendidikan Ibu</label>
                                            <select id="mother_education" name="mother_education"
                                                class="form-control" wire:model="mother_education">
                                                <option value="">Pilih pendidikan ibu</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Sarjana">Sarjana</option>
                                                <option value="Magister">Magister</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="mother_occupation" class="fw-bold">Pekerjaan Ibu</label>
                                            <input type="text" id="mother_occupation" name="mother_occupation"
                                                class="form-control" placeholder="Masukkan pekerjaan ibu"
                                                wire:model="mother_occupation">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @elseif($currentPage === 3)
                            <div class="form-step" id="step3">
                                <h5 class="mb-3 fw-bold">Berkas Pendaftaran</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="pas_foto" class="fw-bold">Pas Foto</label>
                                            <input type="file" id="pas_foto" class="form-control"
                                                onchange="previewImage(event)" wire:model="pas_foto"
                                                wire:loading.attr="disabled">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="akte_kelahiran" class="fw-bold">Akt Kelahiran</label>
                                            <input type="file" id="akte_kelahiran" class="form-control"
                                                wire:model="akte_kelahiran" wire:loading.attr="disabled">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="kartu_keluarga" class="fw-bold">Kartu Keluarga</label>
                                            <input type="file" id="kartu_keluarga" class="form-control"
                                                wire:model="kartu_keluarga" wire:loading.attr="disabled">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                        @if ($currentPage > 1)
                            <button type="button" wire:click="previousPage"
                                class="btn btn-secondary ">Previous</button>
                        @endif
                        @if ($currentPage < $totalPages)
                            <button type="button" wire:click="nextPage" class="btn btn-primary">Next</button>
                        @endif


                        @if ($currentPage === $totalPages)
                            <button type="submit" class="btn btn-success ">Submit</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function nextStep() {
        let currentStep = parseInt(localStorage.getItem('currentStep')) || 1;
        currentStep = Math.min(currentStep + 1, 3); // Assuming you have 3 steps
        showStep(currentStep);
    }

    function prevStep() {
        let currentStep = parseInt(localStorage.getItem('currentStep')) || 1;
        currentStep = Math.max(currentStep - 1, 1); // Step 1 is the minimum
        showStep(currentStep);
    }

    function showStep(step) {
        document.querySelectorAll(".form-step").forEach(function(stepDiv) {
            stepDiv.classList.add("d-none");
        });
        document.getElementById("step" + step).classList.remove("d-none");
        localStorage.setItem('currentStep', step);
    }
</script> --}}
