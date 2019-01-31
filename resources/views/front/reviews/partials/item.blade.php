<div>
{{ $review->user->name }} {{ $review->updated_at->diffForHumans() }} <br/>

Rating {{ $review->rating }}<br/>

{{ $review->remarks }}<br/>
</div>