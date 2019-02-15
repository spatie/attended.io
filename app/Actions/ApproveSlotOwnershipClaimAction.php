<?php

namespace App\Actions;

use App\Models\SlotOwnershipClaim;
use App\Models\User;
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

        activity()
            ->performedOn($slot)
            ->log("claim on `{$slot->name}` by `{$claimingUser->email}` has been approved");
    }
}
