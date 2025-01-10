<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Sekolah</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap4/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="assets/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <!-- font awesome / icon -->
    <link rel="stylesheet" href="assets/fontawesome-free-5.13.0-web/css/all.min.css">
    <!-- style custom kita -->
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

</head>

<body>




    @livewire('partials.frontend.navbar')

    {{ $slot }}

    @livewire('partials.frontend.footer')

    <script src="assets/jquery/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/bootstrap4/js/bootstrap.min.js"></script>
    <script src="assets/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="assets/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>
