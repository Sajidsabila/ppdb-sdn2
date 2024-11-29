<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">
            About Us
        </div>
        <div class="card-body">
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
            <div class="row">
                <!-- Gambar dan Form Unggah Gambar di sebelah kiri -->
                <div class="col-md-6">
                    <label for="foto" class="mb-3">
                        @if ($image)
                            <div>
                                <img src="{{ $foto instanceof \Livewire\TemporaryUploadedFile ? $foto->temporaryUrl() : $image }}"
                                    alt="Preview Foto" style="max-width: 200px;">
                            </div>
                        @endif
                    </label>
                    <!-- Input file untuk gambar -->
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        wire:model="foto" wire:change="initializeCKEditor">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <!-- Form deskripsi di sebelah kanan -->
                <div class="col-md-6">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Keterangan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"
                                rows="4" placeholder="Masukkan deskripsi..."></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <!-- CDN untuk CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script> --}}

<script>
    // Fungsi untuk inisialisasi CKEditor
    function initializeCKEditor() {
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    }

    // Menunggu hingga CKEditor siap
    document.addEventListener('livewire:load', function() {
        initializeCKEditor();
    });

    // Inisialisasi ulang CKEditor setelah gambar diupload
    Livewire.on('imageUploaded', function() {
        initializeCKEditor();
    });
</script>
