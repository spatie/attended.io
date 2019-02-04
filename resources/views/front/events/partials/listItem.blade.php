<div>

    <h2><a href="{{ route('events.show', $event->idSlug()) }}">{{ $event->name }}</a></h2>
    {{ $event->timespan() }}
    {{ $event->location }}
    {{ $event->description }}

    @auth
        @if($userAttandance->exist($event))
            @if($user->ends_at->isFuture())
        @endif
    @endauth
</div>