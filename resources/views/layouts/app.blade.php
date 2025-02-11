<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Sekolah</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-5.13.0-web/css/all.min.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <!-- External Font Awesome from CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Stack for dynamic additional CSS -->
    @stack('css')
    <!-- Livewire Styles -->
    @livewireStyles



</head>

<body>

    <!-- Navbar -->
    @livewire('partials.frontend.navbar')

    <!-- Content -->
    {{ $slot }}

    <!-- Footer -->
    @livewire('partials.frontend.footer')

    <!-- jQuery (full version, not slim) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/bootstrap4/js/bootstrap.min.js') }}"></script>

    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>

    <!-- Custom Script JS -->
    <script src="{{ asset('assets/main.js') }}"></script>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Stack for dynamic additional JS -->
    @stack('js')

</body>

</html>
