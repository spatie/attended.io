<a href="{{ route('events.show-schedule', $review->reviewable) }}">{{ $review->reviewable->name }}</a>


at <a href="{{ route('events.show-schedule', $review->reviewable) }}">{{ $review->reviewable->name }}</a> {{ $review->reviewable->country_emoji }}

Rating {{ $review->rating }}<br/>

{{ $review->remarks }}<br/>

{{ $review->created_at->diffForHumans() }}