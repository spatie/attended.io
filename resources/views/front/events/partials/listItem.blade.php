<a href="{{ route('events.show-schedule', $event->idSlug()) }}">
    <div>
        <h2 class="text-3xl text-grey-darker font-condensed">
            {{ $event->name }}
        </h2>
        
        <div>
            <p class="text-grey-light">{{ $event->timespan() }}</p>
            <p>{{ $event->location }} 🇧🇪</p>
        </div>

        @include('front.events.partials.attending', ['attending' => $event->attendedByCurrentUser()])
    </div>
</a>