<div class="bg-grey-lightest p-16">
    <h3><a href="/">attended.io</a></h3>

    <ul class="flex flex-row">
        <li class="mr-3"><a href="{{ route('events') }}">Events</a></li>
        <li class="mr-3"><a href="{{ route('about') }}">About</a></li>
        <li class="mr-3"><a href="{{ route('assets') }}">Assets</a></li>
    </ul>

    <div>
        <ul class="flex flex-row">
            <li class="mr-3"><a href="{{ route('event-admin.events.index') }}">Organizing</a></li>
            <li class="mr-3"><a href="{{ route('speaking') }}">Speaking</a></li>
            <li class="mr-3"><a href="{{ route('attending') }}">Attending</a></li>
        </ul>
    </div>

    @auth
        <div>
            <ul class="flex flex-row">
                <li class="mr-3"><a href="{{ route('profile.talks.show', auth()->user()) }}">Profile</a></li>
                <li class="mr-3"><a href="{{ route('account.settings.edit') }}">Account</a></li>
                <li class="mr-3"><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                    href="{{ route('logout') }}">Log out</a></li>
            </ul>
        </div>
    @endauth

    An open source project by <a href="https://spatie.be">spatie.be</a>
</div>
