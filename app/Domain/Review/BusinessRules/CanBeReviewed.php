<?php

namespace App\Domain\Review\BusinessRules;

use App\Domain\Review\Exceptions\ReviewableEndedTooLongAgo;
use App\Domain\Review\Exceptions\ReviewablehasNotStartedYet;
use App\Domain\Review\Exceptions\ReviewableWasAlreadyReviewed;
use App\Domain\Review\Interfaces\Reviewable;
use App\Domain\User\Models\User;
use App\Services\BusinessRules\BusinessRule;

class CanBeReviewed extends BusinessRule
{
    /** @var \App\Domain\User\Models\User */
    protected $user;

    /** @var \App\Domain\Review\Interfaces\Reviewable */
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
