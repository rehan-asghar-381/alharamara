<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title', config('app.name', 'Laxom Admin'))</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

    <!-- Master Stylesheet -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    @stack('styles')
</head>

<body class="@yield('body-class')">

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- /Preloader -->

    @yield('content')

    <!-- Must needed plugins to run this template -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/default-assets/setting.js') }}"></script>
    <script src="{{ asset('js/default-assets/scrool-bar.js') }}"></script>
    <script src="{{ asset('js/todo-list.js') }}"></script>

    <!-- Active JS -->
    <script src="{{ asset('js/default-assets/active.js') }}"></script>

    @stack('scripts')
</body>

</html>

