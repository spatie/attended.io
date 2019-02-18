<?php

namespace App\Domain\Review\Exceptions;

use App\Models\Interfaces\Reviewable;
use App\Domain\User\Models\User;
use App\Services\BusinessRules\BusinessRuleException;

class ReviewableWasAlreadyReviewed extends BusinessRuleException
{
    public function __construct(User $user, Reviewable $reviewable)
    {
        parent::__construct('You already reviewed this.');
    }
}
