@if(count($slot->owners) > 0)
    by
    @foreach($slot->owners as $owner)
        <a href="{{ route('users.show', $owner->idSlug()) }}">{{ $owner->name }}</a>
    @endforeach
@elseif($slot->speaker_name)
    by {{ $slot->speaker_name }}
@endif