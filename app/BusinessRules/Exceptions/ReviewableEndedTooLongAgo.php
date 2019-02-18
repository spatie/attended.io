<?php

namespace App\BusinessRules\Exceptions;

use App\Models\Interfaces\Reviewable;
use App\Models\User;
use App\Services\BusinessRules\BusinessRuleException;

class ReviewableEndedTooLongAgo extends BusinessRuleException
{
    public function __construct(User $user, Reviewable $reviewable)
    {
        parent::__construct('You cannot review something that happened more than a month ago.');
    }
}
