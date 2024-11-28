<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">
            About Us
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Gambar dan Form Unggah Gambar di sebelah kiri -->
                <div class="col-md-6">
                    <label for="image" class="mb-3">
                        @if ($image)
                            <img id="previewImage" src="{{ $image->temporaryUrl() }}" alt="Image" class="img-fluid"
                                style="max-height: 300px; width: 100%; object-fit: cover;">
                        @endif
                    </label>
                    <!-- Input file untuk gambar -->
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        wire:model="image" wire:change="initializeCKEditor">
                </div>

                <!-- Form deskripsi di sebelah kanan -->
                <div class="col-md-6">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Keterangan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model="description"
                                rows="4" placeholder="Masukkan deskripsi..."></textarea>
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

{{-- <script>
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
</script> --}}
