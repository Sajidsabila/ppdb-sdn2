@include('sweetalert::alert')
<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">Data Galery</div>
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
            <div class="col-12 d-flex justify-content-between">
                <div class="flex-start">
                    <button class="btn btn-primary" wire:click="createGallery">Tambah Data</button>
                </div>
                <div class="flex-end">
                    <input type="search" wire:mode.live="search" placeholder="Pencarian ..." class="form-control">
                </div>
            </div>
            <div class="col-12 py-3">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="fw-bold">
                            <tr>
                                <th class="fw-bold">#</th>
                                <th class="fw-bold">
                                    Gambar Kegiatan
                                </th>
                                <th class="fw-bold">Keterangan / Deskripsi Kegiatan</th>
                                <th class="fw-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gallery as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->name }}"
                                            class="img-fluid " width="200" height="200">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-warning"
                                                wire:click="editGallery({{ $item->id }})">Edit</button>
                                            <button type="button" class="btn btn-danger"
                                                wire:click="deleteGallery({{ $item->id }})">Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center fw-bold">Data Tidak Ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $gallery->links('pagination::bootstrap-5') }}
        </div>


    </div>
    @if ($isModalOpen)
        @include('livewire.backend.admin.gallery.form')
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    window.addEventListener('swal:modal', event => {
        swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });

    function deleteConfirmation() {

        window.addEventListener('swal:confirm', event => {
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit('remove');
                    }
                });
        });
    }
</script>
