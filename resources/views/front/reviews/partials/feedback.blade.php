<h1>Feedback</h1>

@include('front.reviews.partials.form')

@foreach($reviewable->reviews as $review)
    @include('front.reviews.partials.item')
@endforeach