<nav id="nav" class="layout-nav">
    <div class="hidden | md:flex items-center text-white mx-8 mt-8 h-16">
        <div style="width: 12rem">
            @include('front/layouts/partials/logo')
        </div>
    </div> 

    <div class="sticky pin-t min-h-screen flex flex-col justify-between px-8 py-8">
        <div class="mt-8 | md:mt-0">
            <h3 class="menu-title">Events</h3>
            <div class="menu text-lg">
                @guest
                    <ul>
                        <li><a href="{{ route('events') }}">Search events</a></li>
                    </ul>
                @endguest
                {{ Menu::main() }}
            </div>

            <h3 class="mt-10 menu-title">Account</h3>
            <div class="menu text-lg">
                <ul>
                    @guest
                        <li>
                            <a href="{{ route('login') }}">{{ __('Log in') }}</a>
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
                                {{ __('Log out') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>    

        <div class="mt-auto w-auto pt-8">
            <hr class="border-t-2 border-grey w-1/2 opacity-50">
            <div class="menu text-sm pt-6">
                <ul>
                    <li><a href="{{ route('event-admin.events.index') }}">Organizing</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('assets') }}">Assets</a></li>
                </ul>
            </div>
        </div>

        <small class="flex items-end text-grey-light text-xs opacity-50" style="height: 6rem">
                <div>An open source project by <a class="hover:text-white" href="https://spatie.be">spatie.be</a></div>
        </small>
    </div>

    <a class="nav-toggle" href="javascript:document.documentElement.classList.toggle('nav-is-toggled');">
        <span class="nav-toggle-icon"></span>
    </a>
</nav>