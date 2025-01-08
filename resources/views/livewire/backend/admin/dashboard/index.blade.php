<div class="container">
    <!-- Statistics Cards -->
    <div class="my-4">
        <div class="row">
            <!-- Total Pendaftar -->
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-header text-center">Total Pendaftar</div>
                    <div class="card-body text-center">
                        <h1 class="card-title">{{ $data['all'] }}</h1>
                        <p class="card-text">Jumlah siswa terdaftar.</p>
                    </div>
                </div>
            </div>

            <!-- Belum Diverifikasi -->
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

    <!-- Chart Section -->
    <div class="container my-5">
        <div class="row">
            <div class="col-6">
                <canvas id="myChart"></canvas>
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
            'rgba(255, 99, 132, 0.6)', // Merah
            'rgba(54, 162, 235, 0.6)', // Biru
            'rgba(255, 206, 86, 0.6)', // Kuning
            'rgba(75, 192, 192, 0.6)', // Hijau
            'rgba(153, 102, 255, 0.6)', // Ungu
            'rgba(255, 159, 64, 0.6)', // Oranye
        ];

        const borderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
        ];

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.label,
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: chartData.dataset,
                    backgroundColor: colors.slice(0, chartData.dataset.length),
                    borderColor: borderColors.slice(0, chartData.dataset.length),
                    borderWidth: 2,
                    borderRadius: 5, // Membuat sudut bar lebih bulat
                    hoverBackgroundColor: 'rgba(0, 123, 255, 0.5)', // Warna saat hover
                    hoverBorderColor: 'rgba(0, 123, 255, 1)',
                }]
            },
            options: {
                responsive: true, // Membuat chart responsif di berbagai ukuran layar
                scales: {
                    x: {
                        ticks: {
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            autoSkip: true, // Menghindari label x yang terlalu padat
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5,
                            callback: function(value) {
                                return value % 1 === 0 ? value : ''; // Hanya menampilkan bilangan bulat
                            },
                            font: {
                                size: 14,
                                weight: 'bold',
                                family: 'Arial, sans-serif',
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.7)',
                        titleFont: {
                            size: 16,
                        },
                        bodyFont: {
                            size: 14,
                        },
                    }
                },
                animation: {
                    duration: 1500, // Durasi animasi chart
                    easing: 'easeInOutBounce', // Jenis animasi
                }
            }
        });
    </script>
@endpush
