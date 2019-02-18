<?php

namespace App\Domain\Slot\Policies;

use App\Domain\Slot\Models\SlotOwnershipClaim;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SlotOwnershipClaimPolicy
{
    use HandlesAuthorization;

    public function administer(User $user, SlotOwnershipClaim $claim): bool
    {
        return $user->organizes($claim->slot->event);
    }
}
