<?php

namespace App\Domain\Slot\Policies;

use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlotPolicy
{
    use HandlesAuthorization;

    public function claim(User $user, Slot $slot): bool
    {
        if ($user->isSpeaker($slot)) {
            return false;
        }

        if ($user->isClaimingSlot($slot)) {
            return false;
        }

        if (! $user->hasVerifiedEmail()) {
            return false;
        }

        return true;
    }

    public function review(User $user, Slot $slot)
    {
        if ($user->hasReviewed($slot)) {
            return false;
        }

        if ($slot->starts_at->isFuture()) {
            return false;
        }

        if (now()->subDays(60)->greaterThan($slot->ends_at)) {
            return false;
        }

        return true;
    }
}

