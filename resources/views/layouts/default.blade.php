<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="description" content="Dryas Library">
    <meta name="keywords" content="library, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta Color -->
    <meta content='#08192d' name='theme-color' />
    <meta content='#08192d' name='msapplication-navbutton-color' />
    <meta content='#08192d' name='apple-mobile-web-app-status-bar-style' />
    <!-- Icon -->
    <link href="{{ asset('assets/favicon.ico') }}" rel="shortcut icon" type='image/x-icon' />
    <link href='{{ asset('assets/favicon-32x32.png') }}' rel='icon' sizes='32x32' />
    <link href='{{ asset('assets/android-icon-192x192.png') }}' rel='icon' sizes='192x192' />
    <link href='{{ asset('assets/apple-icon-180x180.png') }}' rel='apple-touch-icon' sizes='180x180' />
    <meta content='{{ asset('assets/apple-icon-114x114.png') }}' name='msapplication-TileImage' />
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
        rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/front.css') }}" />
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('components.header')
    @yield('content')
    @include('components.footer')
    <!-- Javascript -->
    <script src="{{ asset('js/front.js') }}"></script>
    <script type="text/javascript">
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
  $(document).ready(function () {    
    $("#tables").DataTable({
        "responsive": true,
        "autoWidth": true,
        "paging":   true,
        "pagingType": "numbers",
        "lengthChange": false,
        "pageLength": 25,
        "ordering": false,
        "info":     false,
      });       
    });
    </script>
</body>

</html>