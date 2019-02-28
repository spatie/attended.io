{{ $reviewable->number_of_reviews }} {{ \Illuminate\Support\Str::plural('review', $reviewable->number_of_reviews) }}<br />
Average rating: {{ $reviewable->average_review_rating }}