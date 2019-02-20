<?php

namespace App\Http\Front\Controllers\Profile;

use App\Domain\User\Models\User;

class ReviewsController
{
    public function __invoke(User $user)
    {
        $reviews = [];

        return view('front.profile.reviews', compact('user', 'reviews'));
    }

}