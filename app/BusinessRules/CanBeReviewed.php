<?php

namespace App\BusinessRules;

use App\BusinessRules\Exceptions\ReviewableEndedTooLongAgo;
use App\BusinessRules\Exceptions\ReviewablehasNotStartedYet;
use App\BusinessRules\Exceptions\ReviewableWasAlreadyReviewed;
use App\Models\Interfaces\Reviewable;
use App\Models\User;
use App\Services\BusinessRules\BusinessRule;

class CanBeReviewed extends BusinessRule
{
    /** @var \App\Models\User */
    protected $user;

    /** @var \App\Models\Interfaces\Reviewable */
    protected $reviewable;

    public function __construct(User $user, Reviewable $reviewable)
    {
        $this->user = $user;

        $this->reviewable = $reviewable;
    }

    public function ensure()
    {
        if ($this->user->hasReviewed($this->reviewable)) {
            throw new ReviewableWasAlreadyReviewed($this->user, $this->reviewable);
        }

        if ($this->reviewable->starts_at->isFuture()) {
            throw new ReviewableHasNotStartedYet($this->user, $this->reviewable);
        }

        if (now()->subDays(30)->greaterThan($this->reviewable->eventOfReviewable()->ends_at)) {
            throw new ReviewableEndedTooLongAgo($this->user, $this->reviewable);
        }
    }
}
