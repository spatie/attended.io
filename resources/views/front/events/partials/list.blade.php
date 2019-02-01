<ul>
    @foreach($events as $event)
        <li>@include('front.events.partials.listItem')</li>
    @endforeach
</ul>