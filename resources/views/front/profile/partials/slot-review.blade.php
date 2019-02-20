<a href="{{ route('slots.show', $review->reviewable) }}">{{ $review->reviewable->name }}</a>
@include('front.slots.partials.by-speaker', ['slot' => $review->reviewable])

at <a href="{{ route('events.show-schedule', $review->reviewable->event) }}">{{ $review->reviewable->event->name }}</a> {{ $review->reviewable->event->country_emoji }}

Rating {{ $review->rating }}<br/>

{{ $review->remarks }}<br/>

{{ $review->created_at->diffForHumans() }}