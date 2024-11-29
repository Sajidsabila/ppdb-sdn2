<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">
            Configuration
        </div>
        <div class="card-body">

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
