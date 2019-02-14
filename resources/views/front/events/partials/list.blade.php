<ul>
    @foreach($events as $event)
        <li>@include('front.events.partials.listItem')</li>
    @endforeach

    @if($events->nextPageUrl())
        <a href="{{ $events->nextPageUrl() }}">
            @if(request()->has('past'))
                Earlier events
            @else
                Later events
            @endif
        </a>
    @endif

    @if($events->previousPageUrl())
        <a href="{{ $events->previousPageUrl() }}">
            @if(request()->has('past'))
                Later events
            @else
                Earlier events
            @endif
        </a>
    @endif
</ul>