@if(count($slot->speakers) > 0)
    by
    @foreach($slot->speakers as $speaker)
        <a href="{{ route('users.show', $speaker->idSlug()) }}">{{ $speaker->name }}</a>
    @endforeach
@elseif($slot->speaker_name)
    by {{ $slot->speaker_name }}
@endif