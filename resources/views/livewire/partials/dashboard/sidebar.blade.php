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
                        class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Pengaturan Halaman -->
                <li
                    class="nav-item {{ request()->routeIs('admin.gallery', 'admin.teacher', 'admin.about') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-layout-text-sidebar-reverse"></i>
                        <p>
                            Pengaturan Halaman
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.gallery') }}" wire:navigate
                                class="nav-link {{ request()->routeIs('admin.gallery') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Halaman Galleri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.teacher') }}" wire:navigate
                                class="nav-link {{ request()->routeIs('admin.teacher') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Halaman Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.about') }}" wire:navigate
                                class="nav-link {{ request()->routeIs('admin.about') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Halaman About</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Widgets -->
                <li class="nav-item {{ request()->routeIs('widgets.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            PPDB
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.form') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Form Pendaftaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../widgets/small-box.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Calon Siswa Terdaftar</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.user') }}" wire:navigate
                        class="nav-link {{ request()->routeIs('admin.user') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-fill me-2"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.academic') }}" wire:navigate
                        class="nav-link {{ request()->routeIs('admin.academic') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-calendar me-2"></i>
                        <p>Tahun Pelajaran</p>
                    </a>
                </li>
                <!-- Configuration -->
                <li class="nav-item">
                    <a href="{{ route('admin.configuration') }}" wire:navigate
                        class="nav-link {{ request()->routeIs('admin.configuration') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear-fill me-2"></i>
                        <p>Configuration</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
