@component('mail::message')
    # Event approved

   Your event `{{ $event->name }}` has been approved.

    After you've made sure you've added all tracks and slots, head over to the <a href="{{ route('event-admin.events.edit', $event->idSlug()) }}">event detail page</a> to publish it.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent