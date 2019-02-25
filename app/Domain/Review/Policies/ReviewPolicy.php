<?php

namespace App\Domain\Review\Policies;

use App\Domain\Review\Models\Review;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Review $review)
    {
        if ($review->user->id === $user->id) {
            return $review->created_at->addMinutes(30)->isFuture();
        }

        if ($review->reviewable->isAdministeredBy($user)) {
            return true;
        };
    }

    public function delete(User $user, Review $review)
    {
        if ($review->user->id === $user->id) {
            return true;
        }

        if ($review->reviewable->isAdministeredBy($user)) {
            return true;
        };
    }
}
