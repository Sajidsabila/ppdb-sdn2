<nav class="navbar navbar-expand-lg navbar-dark bg-biru fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Beranda </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="#">Guru Dan Tendik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.ppdb') }}">PPDB</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @if (auth()->check() && auth()->user()->role === 'user')
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link bg-success text-white dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" role="button">Profile</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user.logout') }}" wire:navigate>Logout</a>
                            <a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link bg-success text-white" wire:navigate href="{{ route('login') }}">Login</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
