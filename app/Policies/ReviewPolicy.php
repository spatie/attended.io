<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\Review;
use App\Models\Slot;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Review $review): bool
    {
        if ($review->user->id === $user->id) {
            return true;
        }

        if ($review->reviewable instanceof Event) {
            return $user->owns($review->reviewable);
        }

        if ($review->reviewable instanceof Slot) {
            return $user->owns($review->reviewable->event);
        }

        throw new Exception("Could not delete the review because it does not belong to an event of slot");
    }
}
