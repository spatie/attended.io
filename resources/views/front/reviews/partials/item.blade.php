<div>
{{ $review->user->name }} {{ $review->updated_at->diffForHumans() }}

{{ $review->text }}
</div>