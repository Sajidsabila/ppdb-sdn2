<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">
            Configuration
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
                <div class="col-md-6">
                    <label for="foto" class="mb-3">
                        @if ($logo)
                            <div>
                                <img src="{{ $logo instanceof \Livewire\TemporaryUploadedFile ? $logo->temporaryUrl() : $logo }}"
                                    alt="Preview Foto" style="max-width: 200px;">
                            </div>
                        @endif
                    </label>
                    <!-- Input file untuk gambar -->
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        wire:model="logo" wire:change="initializeCKEditor">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6">
                    <label>Nama SEkolah</label>
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
