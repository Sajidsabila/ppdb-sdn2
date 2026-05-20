<section id="gallery-detail" style="margin-bottom: 50px;">
    <div class="container">
        <!-- Section Title -->
        <div class="section-title mt-5">
            <h2 class="pt-5">Tenaga Pendidik</h2>
        </div>
        <!-- Gallery Content -->
        <div class="section-body">
            <div class="row">
                @foreach ($teachers as $gallery)
                    <!-- Single Gallery Card -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-lg">
                            <!-- Image -->
                            <div class="custom-card">
                                <div class="ratio ratio-2x3">
                                    <img src="{{ asset('storage/' . $gallery->photo) }}"
                                        class="img-fluid w-100 h-100 object-fit-cover" alt="{{ $gallery->name }}">
                                </div>
                            </div>
                            {{-- <div style="height: 200px; overflow: hidden; border-radius: 10px;">
                                <img src="{{ asset('storage/' . $gallery->photo) }}" class="img-fluid w-100 h-100"
                                    style="object-fit: cover;" alt="Gallery Image">
                            </div> --}}

                            <div class="card-body">
                                <!-- Title -->
                                <h5 class="card-title">{{ $gallery->name }}</h5>

                                <!-- Date -->
                                <h6 class="text-muted" style="font-size: 14px;">
                                    {{ $gallery->position }}
                                </h6>

                                <!-- Description (Optional) -->


                                <!-- View Button -->

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
