<a href="{{ route('events.show-schedule', $event->idSlug()) }}">
    <div>
        <div class="grid gap-4 cols-auto-1fr items-start">
            <div class="avatar bg-white">
                <span class="avatar-content"></span>
            </div> 
            <div>
                <h2 class="text-3xl text-grey-darker font-condensed font-bold">
                    {{ $event->name }}
                </h2>
                <p class="text-xl font-bold text-grey-dark">{{ $event->timespan() }}</p>
                <p class="mt-2 text-base uppercase text-grey-dark">{{ $event->location }} 🇧🇪</p>

            </div>
        </div>

        @include('front.events.partials.attending', ['attending' => $event->attendedByCurrentUser()])
    </div>
</a>