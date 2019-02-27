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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('headers')
</head>
<body>
<div id="app" class="m-4">

    <nav class="md:flex justify-between">
        {{ Menu::main() }}

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
        </ul>
    </nav>

    <main class="py-4">
        @include('front.layouts.partials.unverified-email-warning')
        @include('front.layouts.partials.flashMessage')
        @yield('content')
    </main>

    @include('front.layouts.partials.footer')
</div>
</body>
</html>
