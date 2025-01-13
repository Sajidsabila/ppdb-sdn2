<div class="container-fluid bg-light py-2">
    <div class="d-flex justify-content-between align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list fw-bold fs-4"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto text-end"> <!-- ms-auto untuk memindahkan ke sisi kanan -->
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" id="dropdownUserProfile" data-bs-toggle="dropdown"
                    href="#" role="button" aria-expanded="false">
                    <i class="bi bi-person-circle fs-3 me-2"></i> <!-- Ganti gambar dengan icon user -->
                    <span class="fw-bold">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownUserProfile">
                    <li>
                        <div class="dropdown-header text-primary">
                            <h6 class="fw-bold">Hi, {{ auth()->user()->name }}</h6>
                            <p class="text-muted small mb-0">Role: {{ auth()->user()->role ?? 'User' }}</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('admin.profile') }}"
                                    class="dropdown-item d-flex align-items-center fw-bold">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <span>Profil Saya</span>
                                </a>
                            </li>
                        @elseif(auth()->user()->role === 'operator')
                            <li>
                                <a href="{{ route('operator.profile') }}"
                                    class="dropdown-item d-flex align-items-center fw-bold">
                                    <i class="bi bi-person-circle me-2"></i>
                                    <span>Profil Saya</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('admin.logout') }}" wire:navigate
                                    class="dropdown-item d-flex align-items-center fw-bold">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        @elseif(auth()->user()->role === 'operator')
                            <li>
                                <a href="{{ route('operator.logout') }}" wire:navigate
                                    class="dropdown-item d-flex align-items-center fw-bold">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        @endif
                    @endauth

                </ul>
            </li>
        </ul>
    </div>
</div>
