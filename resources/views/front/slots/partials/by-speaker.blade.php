@if($slot->user)
    by <a href="{{ route('users.show', $slot->user->idSlug()) }}">{{ $slot->user->name }}</a>
@elseif($slot->speaker_name)
    by {{ $slot->speaker_name }}
@endif