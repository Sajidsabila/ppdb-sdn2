<nav class="navbar navbar-expand-lg navbar-dark bg-biru fixed-top">
    <div class="container">

        <!-- BRAND (kalau ada, taruh sini) -->
        <a class="navbar-brand" href="#"> </a>

        <!-- HAMBURGER -->
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                </li>

                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('about') }}">Tentang</a>
                </li>

                <li class="nav-item {{ request()->routeIs('gallery') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                </li>

                <li class="nav-item {{ request()->routeIs('teacher') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('teacher') }}">Guru Dan Tendik</a>
                </li>

                <li class="nav-item {{ request()->routeIs('user.ppdb') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.ppdb') }}">PPDB</a>
                </li>

                <li class="nav-item {{ request()->routeIs('pengumuman') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pengumuman') }}">Pengumuman PPDB</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                @if (auth()->check() && auth()->user()->role === 'user')
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link bg-success text-white dropdown-toggle" data-toggle="dropdown">
                            Profile
                        </a>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link bg-success text-white" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</nav>
