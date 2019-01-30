<ul>
@foreach($event->slots as $slot)
    <li><a href="{{ route('slots.show', $slot->idSlug()) }}"></a>{{ $slot->name }}</li>
@endforeach
</ul>