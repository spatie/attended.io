<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Attended.io') }}</title>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="dns-prefetch" href="//use.fontawesome.com">

        <link href="https://fonts.googleapis.com/css?family=Encode+Sans:400,600|Encode+Sans+Condensed:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        {{-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#e6002a"> --}}
        <meta name="apple-mobile-web-app-title" content="attended.io">
        <meta name="application-name" content="attended.io">
        <meta name="msapplication-TileColor" content="#e6002a">
        <meta name="theme-color" content="#ffffff">

        @stack('headers')
    </head>
    <body class="bg-paper">
        <div id="app" class="layout">
            @include('front/layouts/partials/nav')

            @yield('main')
        </div>
    </body>
</html>
