<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('components.meta')
</head>

<body>
    @include('components.loader')
    @include('components.header')
    @yield('content')
    @include('components.footer')
    <!-- Javascript -->
    <script src="{{ asset('js/front.js') }}"></script>
    @yield('script')
</body>

</html>