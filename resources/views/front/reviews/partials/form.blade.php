<form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    <input hidden="reviewable_id" value="{{ $reviewable->id }}">
    <input hidden="reviewable_type" value="{{ get_class($reviewable) }}">

    <label for="rating">Rating</label>
    <input type="number" min="0" max="4">

    <label for="remarks">Remarks</label>
    <textarea name="remarks"></textarea>

    <button type="submit">Submit</button>
</form>