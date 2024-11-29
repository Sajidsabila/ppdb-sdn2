<!-- Sidebar -->
<div>
    <div class="sidebar-brand">
        <a href="{{ route('admin.home') }}" class="brand-link">
            <span class="brand-text fw-light fs-3">PPDB Versi 1</span>
        </a>
    </div>
    <div class="sidebar-wrapper fw-bold fs-6">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Menu Pengaturan Halaman -->
                <li
                    class="nav-item {{ request()->routeIs('admin.gallery', 'admin.teacher', 'admin.about') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
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

                <!-- Menu Widgets -->
                <li class="nav-item {{ request()->routeIs('widgets.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Widgets
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../widgets/small-box.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Small Box</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
