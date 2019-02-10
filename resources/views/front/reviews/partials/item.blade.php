<div>
{{ $review->user->name }} {{ $review->updated_at->diffForHumans() }} <br/>

Rating {{ $review->rating }}<br/>

{{ $review->remarks }}<br/>

@auth('delete', $review)
        <action-button :action="route('reviews.delete', $review->id)">
            @method('DELETE')
            <button type="submit">Delete review</button>
        </action-button>
@endauth
</div>