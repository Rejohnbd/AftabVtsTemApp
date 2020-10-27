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
    <link rel="stylesheet" href="{{ asset('plugins/horizontal-menu/dropdown-effects/fade-down.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/charts-c3/c3-chart.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/p-scroll/p-scroll.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/right-sidebar/right-sidebar.css') }}" />
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ asset('css/color11.css') }}" />
</head>

<body class="app">
    @extends('customer.page-partials.loader')
    <div class="page">
        <div class="page-main">
            @include('customer.page-partials.nav-top')
            @include('customer.page-partials.nav-menu')

            @yield('content')
        </div>
        @include('customer.page-partials.right-sidebar')

        @include('customer.page-partials.footer')
    </div>

    <a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('plugins/particles.js-master/particles.js') }}"></script>
    <script src="{{ asset('plugins/particles.js-master/particlesapp_bubble.js') }}"></script>
    <script src="{{ asset('plugins/rating/rating-stars.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/input-mask.min.js') }}"></script>
    <script src="{{ asset('plugins/horizontal-menu/horizontal-menu.js') }}"></script>
    <script src="{{ asset('plugins/p-scroll/p-scroll.js') }}"></script>
    <script src="{{ asset('plugins/p-scroll/p-scroll-1.js') }}"></script>
    <script src="{{ asset('plugins/right-sidebar/right-sidebar.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>