<nav class="navbar navbar-expand-lg bg-primary navbar-light shadow sticky-top p-0">
    <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5 text-white">
        <h3 class="m-0"><i class="fa fa-book me-3"></i>SDN Purwosari 2</h3>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto p-4 p-lg-0">
            <li class="nav-item">
                <a href="index.html" class="nav-link active">Home</a>
            </li>
            <li class="nav-item">
                <a href="about.html" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="courses.html" class="nav-link">Courses</a>
            </li>
            @auth
                @if (auth()->user()->role === 'user')
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <ul class="dropdown-menu dropdown-menu-end fade-down">
                            <li><a wire:click="logout" wire:navigate class="dropdown-item">Logout</a></li>
                            <li><a href="testimonial.html" class="dropdown-item">Profile</a></li>
                        </ul>
                    </li>
                @endif
            @endauth
            @guest
                <li class="nav-item">
                    <a href="{{ route('login') }}" wire:navigate
                        class="btn btn-primary py-4 fw-bold px-lg-5 d-none d-lg-block">Login<i
                            class="fa fa-arrow-right ms-3"></i></a>
                </li>
            @endguest
        </ul>
    </div>
</nav>
