<?php

namespace App\Http\Front\Controllers\Profile;

use App\Domain\User\Models\User;

class ReviewsController
{
    public function __invoke(User $user)
    {
        $reviews = $user
            ->reviews()
            ->orderBy('created_at')
            ->paginate();

        return view('front.profile.reviews', compact('user', 'reviews'));
    }
}
