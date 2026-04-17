@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        #map {
            height: 380px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            z-index: 1;
        }

        .leaflet-container {
            height: 100%;
            width: 100%;
        }

        .card-custom {
            border: 0;
            box-shadow: 0 0.125rem 0.75rem rgba(0, 0, 0, .08);
            border-radius: 14px;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .preview-logo {
            max-width: 220px;
            max-height: 220px;
            object-fit: contain;
        }
    </style>
@endpush


<div class="row">

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show fw-bold">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <form wire:submit.prevent="save" class="col-12">
        <div class="row g-4">

            {{-- LOGO --}}
            <div class="col-lg-4">
                <div class="card card-custom h-100">
                    <div class="card-header bg-primary text-white fw-bold">
                        Logo Sekolah
                    </div>

                    <div class="card-body text-center">

                        <div wire:loading wire:target="logo">
                            <div class="spinner-border text-primary"></div>
                        </div>

                        <div wire:loading.remove wire:target="logo">

                            @if (is_object($logo))
                                <img src="{{ $logo->temporaryUrl() }}" class="img-fluid preview-logo mb-3">
                            @elseif($logo)
                                <img src="{{ $logo }}" class="img-fluid preview-logo mb-3">
                            @else
                                <img src="https://via.placeholder.com/220x220?text=Logo"
                                    class="img-fluid preview-logo mb-3">
                            @endif

                        </div>

                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                            wire:model="logo">

                        @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>


            {{-- DATA SEKOLAH --}}
            <div class="col-lg-8">
                <div class="card card-custom">
                    <div class="card-header bg-primary text-white fw-bold">
                        Data Sekolah
                    </div>

                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="fw-bold">Nama Sekolah</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    wire:model="name">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">NPSN</label>
                                <input type="number" class="form-control @error('npsn') is-invalid @enderror"
                                    wire:model="npsn">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    wire:model="email">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    wire:model="phone">
                            </div>

                            <div class="col-12">
                                <label class="fw-bold">Website</label>
                                <input type="text" class="form-control @error('website') is-invalid @enderror"
                                    wire:model="website">
                            </div>

                            {{-- ALAMAT DI ATAS MAP --}}
                            <div class="col-12 mt-2">
                                <label class="fw-bold">Alamat Sekolah</label>
                                <textarea rows="3" class="form-control @error('address') is-invalid @enderror" wire:model="address"
                                    placeholder="Alamat otomatis terisi saat pin dipindah"></textarea>
                            </div>

                            {{-- MAP --}}
                            <div class="col-12 mt-3">
                                <div class="section-title">
                                    Pilih Lokasi Sekolah
                                </div>

                                <div wire:ignore>
                                    <div id="map"></div>
                                </div>

                                <small class="text-muted d-block mt-2">
                                    Klik peta atau geser pin untuk menentukan lokasi sekolah.
                                </small>
                            </div>

                            <div class="col-12 mt-4">
                                <button class="btn btn-primary px-4">
                                    Simpan Data
                                </button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>
</div>


@push('js')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener("livewire:initialized", () => {

            let map;
            let marker;

            let dbLat = @json($latitude);
            let dbLng = @json($longitude);

            function reverseGeocode(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                    .then(res => res.json())
                    .then(data => {

                        let alamat = data.display_name ?? '';

                        @this.set('address', alamat);
                        @this.dispatch('setLocation', {
                            latitude: lat,
                            longitude: lng
                        });

                    });
            }

            function initMap(lat, lng) {

                if (map) {
                    map.remove();
                }

                map = L.map('map').setView([lat, lng], 17);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 20,
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);

                setTimeout(() => {
                    map.invalidateSize();
                }, 500);

                marker.on('dragend', function() {
                    let pos = marker.getLatLng();
                    reverseGeocode(pos.lat, pos.lng);
                });

                map.on('click', function(e) {
                    marker.setLatLng(e.latlng);
                    reverseGeocode(e.latlng.lat, e.latlng.lng);
                });
            }

            // 🔥 PRIORITAS DATABASE
            if (dbLat && dbLng) {

                initMap(parseFloat(dbLat), parseFloat(dbLng));

            } else if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(function(position) {

                    initMap(
                        position.coords.latitude,
                        position.coords.longitude
                    );

                }, function() {

                    initMap(-6.90389, 107.61861);

                });

            } else {

                initMap(-6.90389, 107.61861);

            }

        });
    </script>
@endpush
