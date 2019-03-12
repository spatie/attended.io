<ul class="cards">
    @foreach($events as $event)
        <li class="bg-white shadow p-4 rounded">
            @include('front.events.partials.listItem')
        </li>
    @endforeach

    <pagination
            :paginator="$events"
            :next-label="request()->has('past') ? 'Earlier events' : 'Later events'"
            :previous-label="request()->has('past') ? 'Later events' : 'Earlier events'"
    />
</ul>