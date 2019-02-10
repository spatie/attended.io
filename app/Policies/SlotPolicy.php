<?php

namespace App\Policies;

use App\Models\Slot;
use App\Models\User;
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

        return true;
    }
}
