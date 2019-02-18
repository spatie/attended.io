<?php

namespace App\Domain\Review\Exceptions;

use App\Domain\Review\Interfaces\Reviewable;
use App\Domain\User\Models\User;
use App\Services\BusinessRules\BusinessRuleException;

class ReviewableEndedTooLongAgo extends BusinessRuleException
{
    public function __construct(User $user, Reviewable $reviewable)
    {
        parent::__construct('You cannot review something that happened more than a month ago.');
    }
}
