<?php

namespace App\Models\Interfaces;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Reviewable
{
    public function reviews(): MorphMany;

    public function recalculateSummary();

    public function isAdministeredBy(User $user): bool;

    public function eventOfReviewable(): Event;

    public function canBeReviewedBy(User $user): bool;
}
