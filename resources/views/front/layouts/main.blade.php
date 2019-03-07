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

            <nav id="nav" class="layout-nav bg-grey-dark">

                <div class="hidden text-white mx-8 mt-16 | md:block" style="width: 12rem">
                    @include('front/layouts/partials/logo')
                </div> 

                <div class="sticky min-h-screen pin-t text-grey-lighter px-8 py-8">
                    <h2 class="font-condensed text-grey-light uppercase text-sm tracking-wide">Events</h2>
                    <ul class="">
                        <li class="my-1 font-bold">
                            Attending
                            <span class="absolute pin-l -ml-8 h-full border-l-4 border-red"></span>
                        </li>
                        <li class="my-1">
                            Speaking
                        </li>
                    </ul>

                    <h2 class="mt-8 font-condensed text-grey-light uppercase text-sm tracking-wide">Account</h2>
                    <ul class="">
                        <li class="my-1">
                            Activity <span></span>
                        </li>
                        <li class="my-1">
                            Profile
                        </li>
                        <li class="my-1">
                            Settings
                        </li>
                    </ul>

                    <ul class="mt-8 pt-8 border-t-2 border-grey text-sm text-grey-light">
                            <li class="py-1">
                                About
                            </li>
                            <li class="py-1">
                                Assets
                            </li>
                            <li class="my-1">
                                Organize an event
                            </li>
                    </ul>

                    <small class="block absolute pin-l pin-b w-full px-8 py-4 text-grey-light text-xs">
                        An open source project by <a href="https://spatie.be">spatie.be</a>
                    </small>
                </div>

                {{-- {{ Menu::main() }}

                <ul class="flex flex-row">
                    @guest
                        <li>
                            <a class="mr-3 p-3 bg-grey-light flex justify-center"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a class="mr-3 p-3 bg-grey-light flex justify-center"
                                href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @endguest

                    @auth
                        <li>
                            <a class="mr-3 p-3 bg-grey-light flex justify-center"
                            href="{{ route('profile.talks.show', auth()->user()->idSlug()) }}">
                                Profile
                            </a>
                        </li>

                        <li>
                            <a class="mr-3 p-3 bg-grey-light flex justify-center" href="{{ route('account.settings.edit') }}">
                                Account
                            </a>
                        </li>

                        <li>
                            <a class="mr-3 p-3 bg-grey-light flex justify-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >
                                {{ __('Logout') }}
                            </a>
                        </li>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </ul> --}}

                <a href="javascript:document.documentElement.classList.toggle('nav-is-toggled');" class="nav-toggle">
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

            {{-- @include('front.layouts.partials.footer') --}}
        </div>
    </body>
</html>
