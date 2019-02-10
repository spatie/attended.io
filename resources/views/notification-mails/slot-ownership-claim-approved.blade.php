@component('mail::message')
# Slot claim approved

Your now own the slot named  <a href="{{ route('slots.show', $slot->idSlug()) }}">{{ $slot->name }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
