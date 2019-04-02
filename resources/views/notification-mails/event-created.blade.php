@component('mail::message')
# Event created

A new event called `{{ $event->name }}` has been created by `{{ $event->organizingUsers->first()->email }}

Head over to the <a href="{{ route('event-admin.events.edit', $event->idSlug()) }}">event detail page</a> to approve it.

This event cannot be published without an admin approving it.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
