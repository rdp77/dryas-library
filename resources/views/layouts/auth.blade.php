<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('components.meta')
</head>

<body>
    @include('components.loader')
    @include('components.header')
    <section class="contact-section">
        <div class="container-fluid">
            <div class="contact-warp">
                <div class="section-title mb-5">
                    <h2>@yield('pageTitle')</h2>
                </div>
                @yield('content')
                @yield('notice')
            </div>
        </div>
    </section>
    @include('components.footer')
    <!-- Javascript -->
    <script src="{{ asset('js/front.js') }}"></script>
</body>

</html>