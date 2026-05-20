<div>
    {{-- <section id="hero-area">
        <div id="slider-hero-nav"></div>
        <div id="slider-hero">
            <div class="slider-item">
                <div class="slider-item-img">
                    <img src="assets/images/2.jpg" alt="" class="src">
                </div>
                <div class="slider-item-content">
                    <h2>Penerimaan Peserta Didik Baru Tahun {{ $ppdb->start_year }}/{{ $ppdb->end_year }}</h2>
                    <h2>Telah Dibuka !</h2>
                    <p>SDN Purwosari 2 membuka pendaftaran siswa baru untuk tahun ajaran
                        {{ $ppdb->start_year ?? 'Tahun Tidak Ada' }}/{{ $ppdb->end_year ?? 'Tahun Tidak Ada' }}. Calon
                        siswa dapat
                        mendaftar secara online melalui website ini atau langsung ke sekolah pendaftaran dibuka dari
                        <span
                            class="fw-bold">{{ \Carbon\Carbon::parse($ppdb->start_registration)->locale('id')->isoFormat('D MMMM YYYY') }}
                            hingga
                            {{ \carbon\Carbon::parse($ppdb->end_registration)->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal Tidak Ada' }}.
                        </span>
                    </p>
                    <p>Klik <b>"Daftar Sekarang"</b> untuk memulai pendaftaran online. Informasi lebih lanjut, hubungi
                        email sdn.purwosari2@gmail.com.</p>
                    @if ($student || (now() >= $ppdb->start_registration && now() <= $ppdb->end_registration))
                        <a href="{{ route('user.ppdb') }}" class="btn btn-utama">
                            Daftar Sekarang
                        </a>
                    @else
                        <button class="btn btn-utama" onclick="alert('Maaf, pendaftaran sudah ditutup')">
                            Daftar Sekarang
                        </button>
                    @endif
                </div>
            </div> <!-- slider item -->

        </div>
    </section> --}}

    <section id="hero-section" class="w-100 min-vh-100 d-flex align-items-center justify-content-center"
        style="
        background-image: url('{{ asset('assets/images/2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">

        <div class="slider-item-content">
            <h2>Penerimaan Peserta Didik Baru Tahun {{ $ppdb->start_year }}/{{ $ppdb->end_year }}</h2>
            <h2>Telah Dibuka !</h2>
            <p>SDN Purwosari 2 membuka pendaftaran siswa baru untuk tahun ajaran
                {{ $ppdb->start_year ?? 'Tahun Tidak Ada' }}/{{ $ppdb->end_year ?? 'Tahun Tidak Ada' }}. Calon
                siswa dapat
                mendaftar secara online melalui website ini atau langsung ke sekolah pendaftaran dibuka dari
                <span
                    class="fw-bold">{{ \Carbon\Carbon::parse($ppdb->start_registration)->locale('id')->isoFormat('D MMMM YYYY') }}
                    hingga
                    {{ \carbon\Carbon::parse($ppdb->end_registration)->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal Tidak Ada' }}.
                </span>
            </p>
            <p>Klik <b>"Daftar Sekarang"</b> untuk memulai pendaftaran online. Informasi lebih lanjut, hubungi
                email sdn.purwosari2@gmail.com.</p>
            @if ($student || (now() >= $ppdb->start_registration && now() <= $ppdb->end_registration))
                <a href="{{ route('user.ppdb') }}" class="btn btn-utama">
                    Daftar Sekarang
                </a>
            @else
                <button class="btn btn-utama" onclick="alert('Maaf, pendaftaran sudah ditutup')">
                    Daftar Sekarang
                </button>
            @endif
        </div>

    </section>

    <!-- Profile Sekolah -->
    <section id="sambutan">
        <div class="container">
            <h2>Profile SDN PURWOSARI 2</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="image-wrapper">
                        <div style="position: relative; padding-top: 56.25%; overflow: hidden; border-radius: 10px;">
                            <img src="{{ asset('storage/' . $about->foto) }}" alt="Image Preview" class="img-fluid"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); background-color: #f5f5f5;">
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h3>Sambutan oleh kepala sekolah</h3>
                    <p>{{ Str::limit($about->description ?? 'Description not available.', 300, '...') }}
                    </p>
                    <a href="{{ url('/about') }}" class="btn btn-utama">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri-pendidik" style="margin-bottom: 50px;">

        <div class="container">

            <div class="section-title">
                <h2>Galeri / Dokumentasi</h2>
            </div>

            <div class="row g-4">

                @forelse($gallery as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                        <div class="custom-card">

                            <div class="custom-card-image">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->name }}"
                                    class="foto-guru img-fluid">
                            </div>

                            <div class="custom-card-body">

                                <h5>{{ $item->name }}</h5>

                                <h6>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </h6>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <p class="text-center text-muted">
                            Tidak ada galeri yang ditemukan.
                        </p>
                    </div>
                @endforelse

            </div>

            <div class="tombol-selengkapnya mt-4 text-center">
                <a href="{{ url('/galeri') }}" class="btn btn-more">
                    Lihat Galeri Lainnya
                </a>
            </div>

        </div>

    </section>

    <!-- section tenaga pendidik -->
    <section id="tenaga-pendidik" style="margin-bottom: 50px;">

        <div class="container">

            <div class="section-title">
                <h2>Tenaga Pendidik</h2>
            </div>

            <div class="row g-4">

                @forelse($teacher as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">

                        <div class="custom-card">

                            <div class="ratio ratio-4x3">
                                <img src="{{ asset('storage/' . $item->photo) }}"
                                    class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $item->name }}">
                            </div>

                            <div class="custom-card-body">
                                <h5>{{ $item->name }}</h5>
                                <h6>{{ $item->position }}</h6>
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">
                        <p class="text-center text-muted">
                            Data guru belum tersedia
                        </p>
                    </div>
                @endforelse

            </div>

            <div class="tombol-selengkapnya mt-4 text-center">
                <a href="{{ url('/teacher') }}" class="btn btn-more">
                    Lihat Semua Guru
                </a>
            </div>

        </div>

    </section>
</div>
@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            window.Livewire.on('warning', message => {
                console.log('Event show-warning diterima:', message);
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: message,
                    confirmButtonText: 'OK'
                });
            });
        });
    </script>
@endpush
