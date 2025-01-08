<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">Tahun Pelajaran</div>
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
                    <button class="btn btn-primary" wire:click="createAcademic">Tambah Data</button>
                </div>
                <div class="flex-end">
                    <input type="search" wire:model.live="search" placeholder="Pencarian ..." class="form-control">
                </div>
            </div>
            <div class="col-12 py-3">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="fw-bold">
                            <tr>
                                <th>#</th>
                                <th>Tahun Pelajaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($academics as $key => $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->start_year . '/' . $item->end_year }}</td>
                                    <td>
                                        <select wire:change="toggleIsActive({{ $item->id }})" class="form-control">
                                            <option value="1" @if ($item->is_active) selected @endif>
                                                Aktif</option>
                                            <option value="0" @if (!$item->is_active) selected @endif>
                                                Tidak Aktif</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-warning"
                                                wire:click="updateAcademic({{ $item->id }})">Edit</button>
                                            <button class="btn btn-danger"
                                                wire:click="deleteUser({{ $item->id }})">Hapus</button>
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
            {{ $academics->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.backend.admin.academicyear.form')
    @endif
    <!-- Custom Pagination with Showing -->
</div>

<script>
    function updateEndYear() {
        const startYear = document.getElementById('start_year').value;
        const endYearInput = document.getElementById('end_year');

        endYearInput.value = startYear ? parseInt(startYear) + 1 : '';
    }
</script>
