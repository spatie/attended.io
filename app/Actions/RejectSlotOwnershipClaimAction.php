<?php

namespace App\Actions;

use App\Models\SlotOwnershipClaim;
use App\Notifications\SlotOwnershipClaimRejectedNotification;

class RejectSlotOwnershipClaimAction
{
    public function execute(SlotOwnershipClaim $claim)
    {
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $claim->delete();

        $claimingUser->notify(new SlotOwnershipClaimRejectedNotification(
            $claimingUser,
            $slot,
            ));

        activity()
            ->performedOn($slot)
            ->log("claim on `{$slot->name}` by `{$claimingUser->email}` has been rejected");


    }
}
