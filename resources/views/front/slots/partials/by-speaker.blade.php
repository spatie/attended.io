@if(count($slot->speakers) > 0)
    by {{ $slot->speakersAsString() }}
@endif