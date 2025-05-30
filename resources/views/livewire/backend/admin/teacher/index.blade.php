@include('sweetalert::alert')
<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">Data Guru</div>
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
                    <button class="btn btn-primary" wire:click="createTeacher">Tambah Data</button>
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
                                    Foto
                                </th>
                                <th class="fw-bold">Nama Guru</th>
                                <th class="fw-bold">Jabatan</th>
                                <th class="fw-bold">Keterangan</th>
                                <th class="fw-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                                            class="img-fluid" style="width: 200px; height: 200px; object-fit: cover;">
                                    </td>

                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-warning"
                                                wire:click="updateTeacher({{ $item->id }})">Edit</button>
                                            <button type="button" class="btn btn-danger"
                                                wire:click="deleteGallery({{ $item->id }})"
                                                wire:confirm="deleteConfirmation()">Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center fw-bold">Data Tidak Ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $teachers->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.backend.admin.teacher.form')
    @endif

</div>
<script></script>
