<?php

namespace App\Policies;

use App\Models\Slot;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlotPolicy
{
    use HandlesAuthorization;

    public function claim(User $user, Slot $slot): bool
    {
        if ($user->owns($slot)) {
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

    public function review(): bool
    {
        return true;
    }
}
