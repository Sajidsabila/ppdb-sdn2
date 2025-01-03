@include('sweetalert::alert')

<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">Data Siswa</div>
        <div class="card-body">
            <!-- Pesan Flash -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="col-12 d-flex justify-content-between">
                <div class="flex-start">
                    <a href="{{ route('admin.form') }}" class="btn btn-primary" wire:navigate>Tambah Data</a>
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
                                <th class="fw-bold">#</th>
                                <th class="fw-bold">ID Pendaftaran</th>
                                <th class="fw-bold">Nama Siswa</th>
                                <th class="fw-bold">Status Berkas</th>
                                <th class="fw-bold">Status</th>
                                <th class="fw-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if ($item->isFilesComplete())
                                            <span class="badge badge-success">Lengkap</span>
                                        @else
                                            <span class="badge badge-warning">Kurang Lengkap</span>
                                        @endif
                                    </td>
                                    <td>
                                        <select
                                            wire:change="toggleChangeStatus('{{ $item->id }}', $event.target.value)"
                                            class="form-control">
                                            <option value="pending" @selected($item->status === 'pending')>Pending</option>
                                            <option value="verified" @selected($item->status === 'verified')>Verified</option>
                                            <option value="accepted" @selected($item->status === 'accepted')>Accepted</option>
                                            <option value="rejected" @selected($item->status === 'rejected')>Rejected</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('admin.detail', ['studentId' => strval($item->id)]) }}"
                                                class="btn btn-info">Detail</a>
                                            <a href="{{ route('admin.form', ['studentId' => strval($item->id)]) }}"
                                                class="btn btn-warning">Edit</a>

                                            <!-- Tombol Hapus -->
                                            <button type="button" class="btn btn-danger"
                                                data-id="{{ strval($item->id) }}" id="delete-btn">Hapus</button>
                                            <button type="button" class="btn btn-secondary"
                                                wire:click="generatePdf('{{ $item->id }}')">Cetak</button>

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
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        const showLoading = () => {
            Swal.fire({
                title: 'Proses Penghapusan...',
                text: 'Sedang memproses, harap tunggu...',
                icon: 'info',
                allowOutsideClick: false,
                showCancelButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        };

        $(document).on('click', '#delete-btn', function() {
            var studentId = $(this).data('id');
            Swal.fire({
                title: "Apakah Kamu Yakin?",
                text: "Ingin menghapus data ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                preConfirm: () => {
                    showLoading();
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '/api/students/' + studentId,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.success
                            });
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: xhr.responseJSON.error
                            });
                        }
                    });
                }
            });
        });
    });
</script>
