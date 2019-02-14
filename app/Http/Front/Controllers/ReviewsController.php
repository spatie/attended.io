<?php

namespace App\Http\Front\Controllers;

use App\Actions\StoreReviewAction;
use App\Http\Front\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ReviewsController
{
    use AuthorizesRequests;

    public function store(StoreReviewRequest $request, StoreReviewAction $storeReviewAction)
    {
        $this->authorize('addReview', $request->reviewable());

        $storeReviewAction->execute(
            Auth::user(),
            $request->reviewable(),
            $request->validated()
        );

        flash()->success("Thank you for your review!");

        return back();
    }

    public function delete(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        flash()->success('The review has been deleted!');

        return back();
    }
}
