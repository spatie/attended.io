@component('mail::message')
# Hurray

You'll be presenting '{{ $slot->name }}' at '{{ $slot->event->name }}'.

@if(! $speaker->hasUserAccount())
    You can create a new account <a href="{{ route('register') }}">here</a>
@endif

You can add your presentation to your profile by <a href="{{ route('slots.show', $slot) }}">claiming your slot</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
