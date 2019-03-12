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
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#e6002a">
        <meta name="apple-mobile-web-app-title" content="attended.io">
        <meta name="application-name" content="attended.io">
        <meta name="msapplication-TileColor" content="#e6002a">
        <meta name="theme-color" content="#ffffff">

        @stack('headers')
    </head>
    <body class="bg-paper">
        <div id="app" class="layout">
            <nav id="nav" class="layout-nav">
                <div class="hidden | md:flex items-center text-white mx-8 mt-8 h-16">
                    <div style="width: 12rem">
                        @include('front/layouts/partials/logo')
                    </div>
                </div> 

                <div class="sticky pin-t min-h-screen flex flex-col justify-between px-8 py-8">
                    <div class="mt-8 | md:mt-0">
                        <h3 class="menu-title">Events</h3>
                        <nav class="menu text-lg">
                            @guest
                                <ul>
                                    <li><a href="{{ route('events') }}">Search events</a></li>
                                </ul>
                            @endguest
                            {{ Menu::main() }}
                        </nav>

                        <h3 class="mt-10 menu-title">Account</h3>
                        <nav class="menu text-lg">
                            <ul>
                                @guest
                                    <li>
                                        <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @endguest

                                @auth
                                    <li>
                                        <a href="{{ route('profile.talks.show', auth()->user()->idSlug()) }}">
                                            Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('account.settings.edit') }}">
                                            Account
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        >
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>    

                    <div class="mt-auto w-auto pt-8">
                        <hr class="border-t-2 border-grey w-1/2 opacity-50">
                        <nav class="menu text-sm pt-6">
                            <ul class="text-sm">
                                <li><a href="{{ route('event-admin.events.index') }}">Organizing</a></li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li><a href="{{ route('assets') }}">Assets</a></li>
                            </ul>
                        </nav>
                    </div>

                    <small class="flex items-end text-grey-light text-xs opacity-50" style="height: 6rem">
                            <div>An open source project by <a class="hover:text-white" href="https://spatie.be">spatie.be</a></div>
                    </small>
                </div>

                <a class="nav-toggle" href="javascript:document.documentElement.classList.toggle('nav-is-toggled');">
                    <span class="nav-toggle-icon"></span>
                </a>
            </nav>

            <main class="layout-content pt-8 pb-16 px-8 | md:px-16 md:py-16">
                <div class="flex justify-end">
                    <div class="block mb-8 text-grey-darker | md:hidden md:mb-0" style="width: 12rem">
                        @include('front/layouts/partials/logo')
                    </div> 
                </div> 
                <div class="max-w-2xl">
                    @include('front.layouts.partials.unverified-email-warning')
                    @include('front.layouts.partials.flashMessage')
                    @yield('content')
                </div>  
            </main>
        </div>
    </body>
</html>
