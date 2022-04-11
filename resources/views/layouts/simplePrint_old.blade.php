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
    {{-- <div class="container"> --}}
        <div class="container-fluid" style="border:1px solid black;">
            <div class="m-3">
                <u>
                    <h4 class="text-uppercase">
                        @yield('title')
                    </h4>
                </u>
                @yield('content')
                <div class="row mt-10 text-center">
                    <div class="col-12 mt-3">
                        {{ __('**Tanda Terima ini sah sebagai bukti Pemberian Kredit, KSP Sumber Rejeki**') }}
                    </div>
                    <div class="col-12 mt-3">
                        {{ __('Untuk informasi lebih lanjut silahkan hubungi KSP Sumber Rejeki : 082222…..') }}
                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    window.print();
</script>

</html>