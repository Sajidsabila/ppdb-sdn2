@include('sweetalert::alert')
<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white">Data User</div>
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
                    <button class="btn btn-primary" wire:click="createUser">Tambah Data</button>
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
                                <th class="fw-bold">Username</th>
                                <th class="fw-bold">Email</th>
                                <th class="fw-bold">Role</th>
                                <th class="fw-bold">Tanggal Verifikasi Akun</th>
                                <th class="fw-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $user->name }}
                                    </td>

                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->email_verified_at ?? 'tidak diverifikasi' }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-warning"
                                                wire:click="updateUser('{{ $user->id }}')">Edit</button>
                                            <button type="button" class="btn btn-danger"
                                                data-id="{{ strval($user->id) }}" id="delete-btn">Hapus</button>
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
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @if ($isModalOpen)
        @include('livewire.backend.admin.user.form')
    @endif
</div>
@push('js')
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
                            url: '/api/user/' + studentId,
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
@endpush
