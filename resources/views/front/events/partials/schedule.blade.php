<ul>
@foreach($event->slots as $slot)
    <li>
        <a href="{{ route('slots.show', $slot->idSlug()) }}">{{ $slot->name }}</a>

        @include('front.slots.partials.by-speaker')
    </li>
@endforeach
</ul>