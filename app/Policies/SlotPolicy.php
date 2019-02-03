<?php

namespace App\Policies;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlotPolicy
{
    public const ABILITY_CLAIM = 'claim';

    use HandlesAuthorization;

    public function claim(User $user, Slot $slot)
    {
        if ($user->owns($slot)) {
            return false;
        }

        if ($user->claimingOwnership($slot)) {
            return false;
        }

        return true;
    }
}
