<!-- Statistics Cards -->
<div style="max-height: 100vh; overflow-y: auto;">
    <div class="my-4">
        <div class="col-12">
            <div class="alert alert-success d-flex align-items-center" role="alert"
                style="background: linear-gradient(90deg, rgba(34,193,195,1) 0%, rgba(253,187,45,1) 100%); border-radius: 10px; padding: 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #fff; margin-right: 15px;"></i>
                <div>
                    <h5 class="text-white" style="font-weight: bold; font-size: 1.5rem;">Selamat Datang
                        {{ auth()->user()->name }} Di Aplikasi PPDB SDN Purwosari 2</h5>
                    <p class="mb-0 text-white" style="font-size: 1rem; opacity: 0.9;">Semoga hari Anda menyenankan!
                        Silakan pilih menu yang ada di sebelah kiri.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-header text-center">Belum Diverifikasi</div>
                    <div class="card-body text-center">
                        <h1 class="card-title">{{ $data['pending'] }}</h1>
                        <p class="card-text">Jumlah siswa belum diverifikasi.</p>
                    </div>
                </div>
            </div>

            <!-- Sudah Diverifikasi -->
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-header text-center">Sudah Diverifikasi</div>
                    <div class="card-body text-center">
                        <h1 class="card-title">{{ $data['verified'] }}</h1>
                        <p class="card-text">Jumlah siswa sudah diverifikasi.</p>
                    </div>
                </div>
            </div>

            <!-- Diterima -->
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-header text-center">Diterima</div>
                    <div class="card-body text-center">
                        <h1 class="card-title">{{ $data['accepted'] }}</h1>
                        <p class="card-text">Jumlah siswa diterima.</p>
                    </div>
                </div>
            </div>

            <!-- Ditolak -->
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-header text-center">Ditolak</div>
                    <div class="card-body text-center">
                        <h1 class="card-title">{{ $data['rejected'] }}</h1>
                        <p class="card-text">Jumlah siswa ditolak.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h6 class="text-white fw-bold">Profil Sekolah</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="schoolName" class="fw-bold">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="schoolName" wire:model="name"
                                        readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="schoolAddress" class="fw-bold">Alamat</label>
                                    <input type="text" class="form-control" id="schoolAddress" wire:model="address"
                                        readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="schoolEmail" class="fw-bold">Email</label>
                                    <input type="email" class="form-control" id="schoolEmail" wire:model="email"
                                        readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="schoolPhone" class="fw-bold">Telepon</label>
                                    <input type="text" class="form-control" id="schoolPhone" wire:model="phone"
                                        readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="fw-bold">Grafik Statistik</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        let chartData = JSON.parse(`<?php echo $student; ?>`);

        const colors = [
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.label,
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: chartData.dataset,
                    backgroundColor: colors.slice(0, chartData.dataset.length),
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    </script>
@endpush
