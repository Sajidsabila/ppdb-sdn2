<section id="ppdb-section"
    style="margin-bottom: 30px; display: flex; align-items: center; justify-content: center; min-height: 80vh;">
    <div class="container mt-3">
        <div class="section-title text-center mt-2 mb-3">
            <div class="section-title mt-5">
                <h2 class="pt-5">Pendaftaran Peserta Didik Baru (PPDB)</h2>
            </div>
        </div>
        <div class="section-body">
            <div class="card shadow-lg" style="max-width: 1000px; margin: auto; border-radius: 12px;">
                <div class="card-header text-white bg-primary"
                    style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                    <h5 class="card-title text-center mb-0 py-2">Form Pendaftar</h5>
                </div>
                <div class="card-body">
                    <form wire:submit="save">
                        @csrf
                        @if ($currentPage === 1)

                            <div class="row g-2">
                                <div class="col-12">
                                    <h6 class="text-primary fw-bold mb-3">Data Pribadi</h6>

                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-floating mb-2">
                                        <label for="name" style="font-size: 0.7rem;">Nama</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Nama" style="font-size: 0.7rem;"
                                            wire:model="name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="religion" style="font-size: 0.7rem;">Agama</label>
                                        <select id="religion" name="religion"
                                            class="form-control form-control-sm @error('religion') is-invalid @enderror"
                                            style="font-size: 0.7rem;" wire:model="religion">
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
                                    <div class="form-floating mb-2">
                                        <label for="birthplace" style="font-size: 0.7rem;">Tempat Lahir</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror"
                                            id="birthplace" name="birthplace" placeholder="Tempat Lahir"
                                            style="font-size: 0.7rem;" wire:model="place_of_birth" required>
                                        @error('place_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="child_status" style="font-size: 0.7rem;">Status Dalam
                                            Keluarga</label>
                                        <select id="child_status" name="child_status"
                                            class="form-control form-control-sm @error('child_status') is-invalid @enderror"
                                            style="font-size: 0.7rem;" wire:model="child_status">
                                            <option value="">Pilih Status</option>
                                            <option value="Anak Kandung">Anak Kandung</option>
                                            <option value="Anak Angkat">Anak Angkat</option>
                                            <option value="Anak Tiri">Anak Tiri</option>
                                            <option value="Adik Kandung">Adik Kandung</option>
                                            <option value="Adik Angkat">Adik Angkat</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        @error('child_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="phone" style="font-size: 0.7rem;">Nomor Telepon</label>
                                        <input type="number" id="phone" name="phone"
                                            class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                            placeholder="Masukkan Nomor Telepon" style="font-size: 0.7rem;"
                                            wire:model="phone">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <div class="form-floating mb-2">
                                        <label for="nik" style="font-size: 0.7rem;">NIK</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('nik') is-invalid @enderror"
                                            id="nik" name="nik" placeholder="NIK" style="font-size: 0.7rem;"
                                            wire:model="nik" required>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="gender" style="font-size: 0.7rem;">Jenis Kelamin</label>
                                        <select
                                            class="form-control form-control-sm @error('gender') is-invalid @enderror"
                                            id="gender" name="gender" style="font-size: 0.7rem;"
                                            wire:model="gender" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki - laki">Laki - laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="dob" style="font-size: 0.7rem;">Tanggal Lahir</label>
                                        <input type="date"
                                            class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
                                            id="date_of_birth" name="date_of_birth" style="font-size: 0.7rem;"
                                            wire:model="date_of_birth" required>
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="number_of_siblings" style="font-size: 0.7rem;">Jumlah
                                            Saudara</label>
                                        <input type="number" id="number_of_siblings" name="number_of_siblings"
                                            class="form-control form-control-sm @error('number_of_siblings') is-invalid @enderror"
                                            placeholder="Masukkan jumlah saudara" style="font-size: 0.7rem;"
                                            wire:model="number_of_siblings">
                                        @error('number_of_siblings')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-2">
                                        <label for="email" style="font-size: 0.7rem;">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-sm @error('email') is-invalid @enderror"
                                            placeholder="Masukkan Email" style="font-size: 0.7rem;"
                                            wire:model="email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 mb-2">

                                    <!-- 🗺️ MAP -->
                                    <div wire:ignore>
                                        <div id="map" style="height: 300px; border-radius:10px;"></div>
                                    </div>

                                    <!-- INPUT LAT LONG (hidden atau readonly) -->
                                    <input type="hidden" wire:model="latitude" class="form-control mt-2" readonly>
                                    <input type="hidden" wire:model="longitude" class="form-control mt-2" readonly>

                                    <!-- ALAMAT -->

                                    <div class="form-floating mt-2">
                                        <label>Alamat Lengkap</label>
                                        <textarea class="form-control form-control-sm @error('address') is-invalid @enderror"
                                            style="height: 100px; font-size: 0.7rem;" wire:model="address" readonly></textarea>
                                    </div>

                                </div>
                            @elseif($currentPage === 2)
                                <div class="row g-2">
                                    <div class="col-12">
                                        <h6 class="text-primary fw-bold mb-3">Data Orang Tua</h6>

                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating mb-2">
                                            <label for="father_name" style="font-size: 0.7rem;">Nama Ayah</label>
                                            <input type="text" id="father_name" name="father_name"
                                                class="form-control form-control-sm @error('father_name') is-invalid @enderror"
                                                placeholder="Masukkan nama ayah" style="font-size: 0.7rem;"
                                                wire:model="father_name">
                                            @error('father_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-2">
                                            <label for="father_education" style="font-size: 0.7rem;">Pendidikan
                                                Ayah</label>
                                            <select id="father_education" name="father_education"
                                                class="form-control form-control-sm @error('father_education') is-invalid @enderror"
                                                wire:model="father_education" style="font-size: 0.7rem;">
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
                                        <div class="form-floating mb-2">
                                            <label for="father_occupation" style="font-size: 0.7rem;">Pekerjaan
                                                Ayah</label>
                                            <select id="father_occupation" name="father_occupation"
                                                class="form-control form-control-sm @error('father_occupation') is-invalid @enderror"
                                                wire:model="father_occupation" style="font-size: 0.7rem;">
                                                <option value="">Pilih pekerjaan ayah</option>
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

                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating mb-2">
                                            <label for="mother_name" style="font-size: 0.7rem;">Nama Ibu</label>
                                            <input type="text" id="mother_name" name="mother_name"
                                                class="form-control form-control-sm @error('mother_name') is-invalid @enderror"
                                                placeholder="Masukkan nama ibu" style="font-size: 0.7rem;"
                                                wire:model="mother_name">
                                            @error('mother_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-2">
                                            <label for="mother_education" style="font-size: 0.7rem;">Pendidikan
                                                Ibu</label>
                                            <select id="mother_education" name="mother_education"
                                                class="form-control form-control-sm @error('mother_education') is-invalid @enderror"
                                                wire:model="mother_education" style="font-size: 0.7rem;">
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
                                        <div class="form-floating mb-2">
                                            <label for="father_occupation" style="font-size: 0.7rem;">Pekerjaan
                                                Ibu</label>
                                            <select id="mother_occupation" name="mother_occupation"
                                                class="form-control form-control-sm @error('mother_occupation') is-invalid @enderror"
                                                wire:model="mother_occupation" style="font-size: 0.7rem;">>
                                                <option value="">Pilih pekerjaan ibu
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
                                    </div>
                                </div>
                            @elseif($currentPage === 3)
                                <div class="row g-2">
                                    <div class="col-12">
                                        <h6 class="text-primary fw-bold mb-3">Dokumen</h6>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <!-- Pas Foto -->
                                        <div class="form-floating mb-2">
                                            <label for="pas_foto" style="font-size: 0.7rem;" class="fw-bold">Pas
                                                Foto Background Merah Ukuran 4 * 6 (maximal : 1 mb, format: png, jpg,
                                                jpeg)</label>
                                            <input type="file" id="pas_foto"
                                                class="form-control form-control-sm @error('pas_foto') is-invalid @enderror"
                                                wire:model="pas_foto" wire:loading.attr="disabled"
                                                style="font-size: 0.7rem;">
                                            @error('pas_foto')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div wire:loading wire:target="logo">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <div wire:loading.remove wire:target="logo">
                                                <!-- Preview Pas Foto -->
                                                @if (is_object($pas_foto))
                                                    <div class="mt-2">
                                                        <img src="{{ $pas_foto->temporaryUrl() }}"
                                                            alt="Preview Pas Foto" class="img-fluid" width="150">
                                                    </div>
                                                @elseif($pas_foto)
                                                    <img src="{{ $pas_foto }}" alt="Preview Pas Foto"
                                                        class="img-fluid" width="150">
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Akte Kelahiran -->
                                        <div class="form-floating mb-2">
                                            <label for="akte_kelahiran" style="font-size: 0.7rem;"
                                                class="fw-bold">Akte Kelahiran Akte Kelahiran (maximal: 1mb, format:
                                                pdf)</label>
                                            <input type="file" id="akte_kelahiran"
                                                class="form-control form-control-sm @error('akte_kelahiran') is-invalid @enderror"
                                                wire:model="akte_kelahiran" style="font-size: 0.7rem;">
                                            @error('akte_kelahiran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if ($akte_kelahiran)
                                                <div class="mt-2">
                                                    <iframe src="{{ $akte_kelahiran }}" frameborder="0"
                                                        style="width: 100%; height: 300px;" allowfullscreen></iframe>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Kartu Keluarga -->
                                        <div class="form-floating mb-2">
                                            <label for="kartu_keluarga" style="font-size: 0.7rem;"
                                                class="fw-bold">Kartu Keluarga Akte Kelahiran (maximal: 1mb, format:
                                                pdf)</label>
                                            <input type="file" id="kartu_keluarga"
                                                class="form-control form-control-sm @error('kartu_keluarga') is-invalid @enderror"
                                                wire:model="kartu_keluarga" style="font-size: 0.7rem;">
                                            @error('kartu_keluarga')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if ($kartu_keluarga)
                                                <div class="mt-2">
                                                    <iframe src="{{ $kartu_keluarga }}" frameborder="0"
                                                        style="width: 100%; height: 300px;" allowfullscreen></iframe>
                                                </div>
                                            @elseif(is_object($kartu_keluarga))
                                                <iframe src="{{ $kartu_keluarga->temporaryUrl() }}" frameborder="0"
                                                    style="width: 100%; height: 300px;" allowfullscreen></iframe>
                                            @endif
                                        </div>

                                        <div class="form-floating mb-2">
                                            <label for="dokumen_pendukung" style="font-size: 0.7rem;"
                                                class="fw-bold">Dokumen Pendukung Akte Kelahiran (maximal: 1mb, format:
                                                pdf)</label>
                                            <input type="file" id="dokumen_pendukung"
                                                class="form-control form-control-sm @error('dokumen_pendukung') is-invalid @enderror"
                                                wire:model="dokumen_pendukung" style="font-size: 0.7rem;">
                                            @error('dokumen_pendukung')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            @if ($dokumen_pendukung)
                                                <div class="mt-2">
                                                    <iframe src="{{ $dokumen_pendukung }}" frameborder="0"
                                                        style="width: 100%; height: 300px;" allowfullscreen></iframe>
                                                </div>
                                            @elseif(is_object($dokumen_pendukung))
                                                <iframe src="{{ $dokumen_pendukung->temporaryUrl() }}"
                                                    frameborder="0" style="width: 100%; height: 300px;"
                                                    allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                        @endif

                        <div class="col-12 text-center">

                            @if ($currentPage === 1)
                                <a href="{{ route('admin.ppdb') }}" class="btn btn-sm btn-secondary">Kembali</a>
                            @endif

                            @if ($currentPage > 1)
                                <button type="button" wire:click="previousPage"
                                    class="btn btn-sm btn-secondary">Previous</button>
                            @endif
                            @if ($currentPage < $totalPages)
                                <button type="button" wire:click="nextPage"
                                    class="btn btn-sm btn-primary">Next</button>
                            @endif

                            @if ($currentPage === $totalPages)
                                <div wire:loading>
                                    <div class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                @if (now() >= $ppdb->start_registration && now() <= $ppdb->end_registration)
                                    <button type="submit" class="btn btn-sm btn-success"
                                        wire:loading.remove>Submit</button>
                                @else
                                    <button class="btn btn-utama" onclick="alert('Maaf, pendaftaran sudah ditutup')">
                                        Daftar Sekarang
                                    </button>
                                @endif

                            @endif
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    let map;
    let marker;
    let mapInitialized = false;

    document.addEventListener("livewire:initialized", () => {

        function initMap() {
            if (mapInitialized) return;

            const mapContainer = document.getElementById('map');
            if (!mapContainer) return;

            // 🔥 AMBIL DATA DARI LIVEWIRE (kalau ada)
            let lat = @this.get('latitude') ?? -6.9;
            let lng = @this.get('longitude') ?? 107.6;

            // 🔥 INIT MAP
            map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            setTimeout(() => {
                map.invalidateSize();
            }, 300);

            // 🔥 MARKER AWAL
            marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            // =========================
            // 📍 AUTO DETECT LOKASI (hanya kalau belum ada data)
            // =========================
            if (!@this.get('latitude') && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        map.setView([lat, lng], 15);

                        marker.setLatLng([lat, lng]);

                        // 🔥 KIRIM KE LIVEWIRE
                        @this.call('setLocation', lat, lng);

                        // 🔥 GET ADDRESS
                        getAddress(lat, lng);
                    },
                    (error) => {
                        console.error('❌ Gagal ambil lokasi:', error);
                    }
                );
            }

            // =========================
            // 📍 FUNCTION GET ADDRESS
            // =========================
            function getAddress(lat, lng) {
                fetch(`/reverse-geocode?lat=${lat}&lng=${lng}`)
                    .then(res => res.json())
                    .then(data => {
                        @this.call('setAddress', data.display_name ?? 'Alamat tidak ditemukan');
                    })
                    .catch(err => console.error('❌ Reverse geocode error:', err));
            }

            // =========================
            // 📍 KLIK MAP
            // =========================
            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;

                marker.setLatLng([lat, lng]);

                // 🔥 KIRIM KE LIVEWIRE
                @this.call('setLocation', lat, lng);

                // 🔥 UPDATE ALAMAT
                getAddress(lat, lng);

                console.log('🖱️ CLICK:', lat, lng);
            });

            // =========================
            // 📍 DRAG MARKER
            // =========================
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();

                @this.call('setLocation', position.lat, position.lng);

                getAddress(position.lat, position.lng);

                console.log('📦 DRAG:', position.lat, position.lng);
            });

            mapInitialized = true;
        }

        // 🔥 INIT DELAY
        setTimeout(initMap, 500);
    });
</script>
