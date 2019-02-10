@component('mail::message')
# Slot claim rejected

Your claim on the <a href="{{ route('slots.show', $slot->idSlug()) }}">{{ $slot->name }}</a> slot has been rejected.

<br>
{{ config('app.name') }}
@endcomponent
