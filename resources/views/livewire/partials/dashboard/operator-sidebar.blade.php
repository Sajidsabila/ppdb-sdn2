<!-- Sidebar -->
<div>
    <!-- Brand Section -->
    <div class="sidebar-brand">
        <a href="{{ route('admin.home') }}" class="brand-link">
            <span class="brand-text fw-light fs-3">PPDB Versi 1</span>
        </a>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper fw-bold fs-6">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" wire:navigate
                        class="nav-link {{ request()->routeIs('operator.home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- PPDB Section -->
                <li
                    class="nav-item {{ request()->routeIs('operator.ppdb', 'operator.form', 'operator.detail') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            PPDB
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('operator.form') }}"
                                class="nav-link {{ request()->routeIs('operator.form') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Form Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('operator.ppdb') }}"
                                class="nav-link {{ request()->routeIs('operator.ppdb', 'operator.detail') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Calon Siswa Terdaftar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('operator.ppdb-acepted') }}"
                                class="nav-link {{ request()->routeIs('operator.ppdb-acepted', 'operator.detail') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Siswa Diterima</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Tahun Pelajaran -->
                <li class="nav-item">
                    <a href="{{ route('admin.academic') }}" wire:navigate
                        class="nav-link {{ request()->routeIs('admin.academic') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar me-2"></i>
                        <p>Tahun Pelajaran</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
