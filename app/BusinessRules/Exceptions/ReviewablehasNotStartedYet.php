<?php

namespace App\BusinessRules\Exceptions;

use App\Models\Interfaces\Reviewable;
use App\Models\User;
use App\Services\BusinessRules\BusinessRuleException;

class ReviewablehasNotStartedYet extends BusinessRuleException
{
    public function __construct(User $user, Reviewable $reviewable)
    {
        parent::__construct('You cannot review something that happens in the future.');
    }
}
