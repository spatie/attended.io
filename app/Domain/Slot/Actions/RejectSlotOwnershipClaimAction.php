<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\SlotOwnershipClaim;
use App\Domain\Slot\Notifications\SlotOwnershipClaimRejectedNotification;

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
