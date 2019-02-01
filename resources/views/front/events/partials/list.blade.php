<ul>
   {{ $events->links() }}

    @foreach($events as $event)
        <li>@include('front.events.partials.listItem')</li>
    @endforeach

   {{ $events->links() }}
</ul>