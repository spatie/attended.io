<ul class="grid cols-2 items-end">
    @foreach($events as $event)
        @if($loop->iteration % 2)
            <li class="pr-8 py-16 border-r-2 border-grey-lightest {{ $loop->last? '' : 'border-b-2' }}" style="grid-column-start:1;grid-row: {{ $loop->iteration }} / span 2">
        @else 
            <li class="pl-16 py-16 border-l-2 border-grey-lightest {{ $loop->last? '' : 'border-b-2' }}" style="left:-2px; grid-column-start:2;grid-row: {{ $loop->iteration }} / span 2">
        @endif 
                @include('front.events.partials.listItem')
            </li>
    @endforeach

    <pagination
            :paginator="$events"
            :next-label="request()->has('past') ? 'Earlier events' : 'Later events'"
            :previous-label="request()->has('past') ? 'Later events' : 'Earlier events'"
    />
</ul>