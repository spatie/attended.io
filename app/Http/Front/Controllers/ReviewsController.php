<?php

namespace App\Http\Front\Controllers;

use App\Actions\StoreReviewAction;
use App\Http\Front\Request\StoreReviewRequest;
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
}