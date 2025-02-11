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
                            <img src="{{ asset('storage/' . $gallery->photo) }}" alt="Gallery Image" class="card-img-top"
                                style="object-fit: cover; height: 200px;">

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
