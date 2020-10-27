<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0' />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="" content="" />
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/skins-modes.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/single-page/css/single-page.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}" />
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('css/color11.css') }}" />
</head>

<body class="app">
    <div class="login-img">
        <div id="global-loader">
            <img src="{{ asset('img/loader.svg') }}" class="loader-img" alt="Loader">
        </div>

        <div class="page h-100">
            <div class="">
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{ asset('img/logo.png') }}" class="header-brand-img" alt="Logo">
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('plugins/rating/rating-stars.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/input-mask.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>