<h2>{{ $event->name }}</h2>
{{ $event->timespan() }}
{{ $event->location }}
{{ $event->description }}

@include('front.events.partials.attending', ['attending' => $event->attendedBy(auth()->user())])

{{ Menu::event($event) }}