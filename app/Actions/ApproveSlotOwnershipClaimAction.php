<?php

namespace App\Actions;

use App\Models\SlotOwnershipClaim;
use App\Notifications\SlotOwnershipClaimApprovedNotification;

class ApproveSlotOwnershipClaimAction
{
    public function execute(SlotOwnershipClaim $claim)
    {
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $slot->owners()->attach($claimingUser);

        $claim->delete();

        $claimingUser->notify(new SlotOwnershipClaimApprovedNotification(
            $claimingUser,
            $slot,
            ));
    }
}
