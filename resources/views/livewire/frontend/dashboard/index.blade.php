@push('css')
    <style>
        .owl-carousel .gallery-item {
            text-align: center;
            /* Tengahkan isi galeri */
            padding: 10px;
            /* Jarak dalam setiap item */
            background: #fff;
            /* Warna latar putih */
            border-radius: 8px;
            /* Membuat sudut melengkung */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Efek bayangan */
        }

        .owl-carousel .gallery-item img.foto-guru {
            display: block;
            /* Pastikan elemen gambar terlihat */
            width: 100%;
            /* Gambar menyesuaikan lebar kontainer */
            height: auto;
            /* Menjaga rasio gambar */
            object-fit: cover;
            /* Isi area kontainer tanpa distorsi */
            border-radius: 8px;
            /* Sudut gambar melengkung */
        }

        .owl-carousel .section-item-caption {
            padding: 8px 0;
            /* Jarak antara teks dan gambar */
        }

        .owl-carousel .section-item-caption h5,
        .owl-carousel .section-item-caption h6 {
            margin: 4px 0;
            /* Jarak antar teks */
            color: #333;
            /* Warna teks utama */
            font-weight: 600;
            /* Teks lebih tebal */
        }

        @media (max-width: 1024px) {
            .owl-carousel .gallery-item {
                padding: 8px;
                /* Kurangi padding di tablet */
            }
        }

        @media (max-width: 768px) {
            .owl-carousel .gallery-item {
                padding: 6px;
                /* Padding lebih kecil untuk layar kecil */
            }

            .owl-carousel .section-item-caption h5,
            .owl-carousel .section-item-caption h6 {
                font-size: 14px;
                /* Ukuran font lebih kecil di mobile */
            }
        }

        @media (max-width: 480px) {
            .owl-carousel .gallery-item {
                padding: 4px;
                /* Padding minimum di layar kecil */
            }

            .owl-carousel .section-item-caption h5 {
                font-size: 12px;
                /* Font heading lebih kecil */
            }

            .owl-carousel .section-item-caption h6 {
                font-size: 10px;
                /* Font subtitle lebih kecil */
            }
        }

        @media (max-width: 600px) {
            .owl-carousel .gallery-item {
                display: block;
                margin: 0 auto;
                /* Tengahkan item */
            }

            .owl-carousel .gallery-item img.foto-guru {
                max-width: 100%;
                height: auto;
            }

            .empty-message {
                text-align: center;
                font-size: 14px;
                color: #888;
                margin-top: 16px;
            }
        }
    </style>
@endpush
<div>
    <section id="hero-area">
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
                        {{ $ppdb->start_year }}/{{ $ppdb->end_year }}. Calon siswa dapat
                        mendaftar secara online melalui website ini atau langsung ke sekolah pendaftaran dibuka dari
                        {{ $ppdb->start_registration }} hingga {{ $ppdb->end_registration }}.</p>
                    <p>Klik <b>"Daftar Sekarang"</b> untuk memulai pendaftaran online. Informasi lebih lanjut, hubungi
                        email sdn.purwosari2@gmail.com.</p>

                    <a href="{{ route('user.ppdb') }}" class="btn btn-utama">Daftar Sekarang</a>
                </div>
            </div> <!-- slider item -->

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
                    <a href="" class="btn btn-utama">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <section id=galeri-pendidik style="margin-bottom: 50px;">
        <div class="container">
            <div class="section-title">
                <h2>Galeri / Dokumentasi</h2>
            </div>
            <div class="section-body">
                <div id="slider-tools-3"></div>
                <div class="owl-carousel" id="galeri-slider">
                    @forelse($gallery as $key => $gallery)
                        <div class="gallery-item">
                            <img class="foto-guru" src="{{ asset('storage/' . $gallery->foto) }}"
                                alt="{{ $gallery->name }}">
                            <div class="section-item-caption">
                                <a href="#">
                                    <h5>{{ $gallery->name }}</h5>
                                </a>
                                <a href="#">
                                    <h6>{{ \Carbon\Carbon::parse($gallery->created_at)->format('d M Y') }}</h6>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="empty-message">Tidak ada galeri yang ditemukan.</p>
                    @endforelse
                </div>

                <div class="tombol-selengkapnya">
                    <a href="" class="btn btn-more">Lihat Galeri Lainnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- section tenaga pendidik -->
    <section id=tenaga-pendidik style="margin-bottom: 50px;">
        <div class="container">
            <div class="section-title">
                <h2>Tenaga Pendidik</h2>
            </div>
            <div class="section-body">
                <div id="slider-tools-1"></div>
                <div class="owl-carousel" id="tenaga-pendidik-slider">
                    @forelse($teacher as $key => $teacher)
                        <div class="section-item-slider">
                            <img class="foto-guru" src="{{ asset('storage/' . $teacher->photo) }}" alt=""
                                srcset="">
                            <div class="section-item-caption">
                                <a href="">
                                    <h5>{{ $teacher->name }}</h5>
                                </a>
                                <a href=""></a>
                                <h6>{{ $teacher->position }}</h6>
                                </a>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
                <div class="tombol-selengkapnya">
                    <a href="" class="btn btn-more">Lihat Semua Guru</a>
                </div>
            </div>
        </div>
    </section>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#galeri-slider').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>

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
