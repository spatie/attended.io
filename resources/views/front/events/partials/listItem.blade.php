<div>

    <h2><a href="{{ route('events.show', $event->idSlug()) }}">{{ $event->name }}</a></h2>
    {{ $event->timespan() }}
    {{ $event->location }}
    {{ $event->description }}

    @auth
        @if($currentUserAttendance->exists($event))
            @if($events->ends_at->isFuture())
                Attending
            @else
                Attended
            @endif
        @else
            Attend
        @endif
    @endauth
</div>