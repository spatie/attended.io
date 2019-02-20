@if(count($slot->speakingUsers) > 0)
    by
    @foreach($slot->speakingUsers as $speakingUser)
        <a href="{{ route('users.show', $speakingUser->idSlug()) }}">{{ $speakingUser->name }}</a>
    @endforeach
@elseif($slot->speaker_name)
    by {{ $slot->speaker_name }}
@endif