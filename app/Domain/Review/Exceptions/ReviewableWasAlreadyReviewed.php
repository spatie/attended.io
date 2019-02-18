<?php

namespace App\Domain\Review\Exceptions;

use App\Domain\Review\Interfaces\Reviewable;
use App\Domain\User\Models\User;
use App\Services\Specifications\SpecificationException;

class ReviewableWasAlreadyReviewed extends SpecificationException
{
    public function __construct(User $user, Reviewable $reviewable)
    {
        parent::__construct('You already reviewed this.');
    }
}
