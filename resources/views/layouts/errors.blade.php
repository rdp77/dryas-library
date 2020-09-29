<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('components.meta')
</head>

<body>
    @include('components.loader')
    <section class="contact-section">
        <div class="container-fluid">
            <div class="contact-warp">
                <div class="section-title mb-5 text-center">
                    <h1 class="mb-3">@yield('code')</h1>
                    <h3 class="alert-heading">@yield('message')</h3>
                    <p>
                        Don't panic! this error is temporary, our team will try to resolve it quickly.
                    </p>
                    <a href="/" class="site-btn">{{ __('Back To Home') }}</a>
                </div>
            </div>
        </div>
    </section>
    @include('components.footer')
    <!-- Javascript -->
    <script src="{{ asset('js/front.js') }}"></script>
</body>

</html>