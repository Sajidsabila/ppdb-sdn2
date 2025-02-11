@include('sweetalert::alert')

<div class="col-12">
    <div class="card">
        <div class="card-header fw-bold bg-primary text-white d-flex justify-content-between">
            <span>Data Siswa</span>
        </div>
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

            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <label for="filterYear" class="form-label">Filter Tahun</label>
                    <select id="filterYear" wire:model.live="selectedYear" class="form-control">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->start_year . '/' . $year->end_year }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6"></div> <!-- Spacer untuk mendorong elemen ke kanan -->

                <div class="col-md-3">
                    <label for="search" class="form-label">Pencarian</label>
                    <input type="search" id="search" wire:model.live="search" placeholder="Pencarian ..."
                        class="form-control">
                </div>
            </div>

            <div class="col-md-4 d-flex align-items-end mb-3">
                <a href="{{ route('admin.form') }}" class="btn btn-primary" wire:navigate>Tambah Data</a>
                <a wire:click="print" class="btn btn-success ms-2" wire:navigate>Cetak Laporan</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="fw-bold">
                        <tr>
                            <th>#</th>
                            <th>ID Pendaftaran</th>
                            <th>Nama Siswa</th>
                            <th>Status Berkas</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
                                        <span class="badge bg-success">Lengkap</span>
                                    @else
                                        <span class="badge bg-warning">Kurang Lengkap</span>
                                    @endif
                                </td>
                                <td>
                                    <select wire:change="toggleChangeStatus('{{ $item->id }}', $event.target.value)"
                                        class="form-control">
                                        <option value="pending" @selected($item->status === 'pending')>Pending</option>
                                        <option value="verified" @selected($item->status === 'verified')>Verified</option>
                                        <option value="accepted" @selected($item->status === 'accepted')>Accepted</option>
                                        <option value="rejected" @selected($item->status === 'rejected')>Rejected</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.detail', ['studentId' => strval($item->id)]) }}"
                                            class="btn btn-info">Detail</a>
                                        <a href="{{ route('admin.form', ['studentId' => strval($item->id)]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <button type="button" class="btn btn-danger" data-id="{{ strval($item->id) }}"
                                            id="delete-btn">Hapus</button>
                                        <button type="button" class="btn btn-secondary"
                                            wire:click="generatePdf('{{ $item->id }}')">Cetak</button>
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

            {{ $students->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk menampilkan loading
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

            // Event handler untuk tombol delete
            $(document).on('click', '#delete-btn', function() {
                const studentId = $(this).data('id'); // Mengambil ID siswa dari atribut data-id

                // Konfirmasi sebelum menghapus data
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
                        // Melakukan permintaan AJAX untuk menghapus data
                        $.ajax({
                            url: `/api/students/${studentId}`, // Endpoint API
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses',
                                    text: response.success ||
                                        'Data berhasil dihapus.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });

                                // Memuat ulang halaman setelah sukses
                                setTimeout(() => location.reload(), 2000);
                            },
                            error: function(xhr) {
                                // Menangani error dari server
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: xhr.responseJSON?.error ||
                                        'Gagal menghapus data, coba lagi.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
