<h2>{{ $event->name }}</h2>
{{ $event->timespan() }}
{{ $event->location }}
{{ $event->description }}

@include('front.events.partials.attending', ['attending' => $event->attendedBy(current_user())])

{{ Menu::event($event) }}