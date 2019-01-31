{{ $reviewable->number_of_reviews }} {{ str_plural($reviewable->number_of_reviews, 'review') }}<br />
Average rating: {{ $reviewable->average_review_rating }}