<?php

namespace App\Http\Front\Controllers;

use App\Actions\StoreReviewAction;
use App\Http\Front\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ReviewsController
{
    public function store(StoreReviewRequest $request, StoreReviewAction $storeReviewAction)
    {
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
