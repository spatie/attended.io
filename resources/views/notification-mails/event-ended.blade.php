@component('mail::message')
    # Please leave us some feedback

    Thanks you so much for attending {{ $event->name }}. We hope you had a good time.

    You can help the speakers improve their presentations by leaving them feedback.

    <a href="{{ route('events.show-schedule', $event) }}">Click here</a> to view the schedule and leave feedback on any of the slots you have attended.

    You can help the organisers improve the next edition by <a href="{{ route('events.show-feedback', $event) }}">leaving some feedback on the event itself.</a>.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent