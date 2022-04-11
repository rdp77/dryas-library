<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('pages.title').__(' | ') }}@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('assets/style.css') }}">
</head>

<style>
    table,
    td,
    th,
    tr {
        border: 1px solid;
    }

    @media screen,
    print {
        body {
            font-size: 12pt;
        }

        .badge-info {
            color: black
        }
    }
</style>

<body>
    <div class="container">
        <div class="text-left row">
            <div class="col">
                <img src="{{ asset('assets/img/circle.png') }}" alt="logo" class="float-left" width="200">
                <div class="row align-items-center mt-5">
                    <div class="col">
                        <h3>{{ __('pages.title') }}</h3>
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        {{ __('Alamat') }}
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        {{ __('Telepon : 902039203923 Email: Agha@kjasd.asd') }}
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        {{ __('Website : ksp-sumberrejeki.com') }}
                    </div>
                </div>
            </div>
        </div>
        <div style="border: 1px solid black"></div>
        <div class="row">
            <div class="col-12 text-center mt-3 mb-5">
                <h3>
                    @yield('titleContent')
                </h3>
            </div>
            @yield('header')
        </div>
        @yield('content')
    </div>
</body>
<script>
    window.print();
</script>

</html>