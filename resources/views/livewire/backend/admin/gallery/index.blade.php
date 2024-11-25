<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">Data Galery</div>
        <div class="card-body">
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
                                <th class="fw-bold">Gambar</th>
                                <th class="fw-bold">Keterangan / Deskripsi Kegiatan</th>
                                <th class="fw-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gallery as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->foto }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-warning"
                                                wire:click="editGallery({{ $item->id }})">Edit</button>
                                            <a class="btn btn-danger">Hapus</a>
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
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.backend.admin.gallery.form')
    @endif
</div>
