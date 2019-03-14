<div id="review-{{ $review->id }}">
    {{ $review->user->name }}
    <a href="{{ $review->getPermalink() }}">{{ $review->updated_at->diffForHumans() }}</a>
    <br/>

    Rating {{ $review->rating }}<br/>

    {{ $review->remarks }}<br/>

    @can('delete', $review)
        <action-button :action="route('reviews.delete', $review->id)">
            @method('DELETE')
            <button type="submit">Delete review</button>
        </action-button>
    @endcan
</div>
