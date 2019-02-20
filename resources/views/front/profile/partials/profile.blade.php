<img src="{{ $user->gravatarUrl() }}" />

{{ $user->name }}
{{ $user->city }} {{ $user->country_emoji }}

{{ $user->bio }}

<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>

@if ($user->site)
    <a href="{{ $user->site }}">{{ presentUrl($user->site) }}</a>
    <a href="{{ $user->joindinProfileUrl() }}">{{ presentUrl($user->joindinProfileUrl()) }}</a>
@endif