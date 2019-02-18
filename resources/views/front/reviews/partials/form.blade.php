@if($reviewable->canBeReviewedByCurrentUser())
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <input type="hidden" name="reviewable_id" value="{{ $reviewable->id }}">
        <input type="hidden" name="reviewable_type" value="{{ get_class($reviewable) }}">

        <label for="rating">Rating</label>
        <input type="number" name="rating" min="0" max="4">

        <label for="remarks">Remarks</label>
        <textarea name="remarks"></textarea>
        @if ($errors->has('remarks'))
            <div class="form-control-feedback">{{ $errors->first('remarks') }}</div>
        @endif

        <button type="submit">Submit</button>
    </form>
@endif
@guest
    You must be logged in to post a review
@endguest