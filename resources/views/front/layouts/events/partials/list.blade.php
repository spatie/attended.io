<ul>
    @foreach($events as $event)
        <li>@include('front.events.partials.listItem')</li>
    @endforeach

    <pagination
            :paginator="$events"
            :next-label="request()->has('past') ? 'Earlier events' : 'Later events'"
            :previous-label="request()->has('past') ? 'Later events' : 'Earlier events'"
    />
</ul>