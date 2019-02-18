<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Review $review): bool
    {
        if ($review->user->id === $user->id) {
            return $review->created_at->addMinutes(30)->isFuture();
        }

        return $review->reviewable->isAdministeredBy($user);
    }

    public function delete(User $user, Review $review): bool
    {
        if ($review->user->id === $user->id) {
            return true;
        }

        return $review->reviewable->isAdministeredBy($user);
    }
}
