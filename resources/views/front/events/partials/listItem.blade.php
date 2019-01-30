<div>

    <h2><a href="{{ route('events.show', $event->idSlug()) }}">{{ $event->name }}</a></h2>
    {{ $event->timespan() }}
</div>