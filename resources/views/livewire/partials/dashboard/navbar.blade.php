<div class="container-fluid bg-light py-2">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Sidebar Toggle -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list fw-bold fs-4"></i>
                </a>
            </li>
        </ul>

        <!-- User Dropdown -->
        <ul class="navbar-nav ms-auto"> <!-- ms-auto untuk memindahkan ke sisi kanan -->
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button">
                    <span class="fw-bold me-2">{{ auth()->user()->name }}</span>
                    <i class="bi bi-person-circle fs-3"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-sm">
                    <div class="dropdown-divider"></div>
                    <a wire:click="logout" class="dropdown-item d-flex align-items-center">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item d-flex align-items-center">
                        <i class="bi bi-people-fill me-2"></i>
                        <span>8 friend requests</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
