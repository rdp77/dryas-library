<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('layouts.frontend.components.meta')
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('layouts.frontend.components.nav')
    @yield('content')
    @include('layouts.frontend.components.footer')
    <!-- Javascript -->
    <script src="{{ mix('front.js') }}"></script>
    @yield('script')
</body>

</html>