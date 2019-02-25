<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\SlotOwnershipClaim;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SlotOwnershipClaimApprovedNotification;

class ApproveSlotOwnershipClaimAction
{
    public function execute(SlotOwnershipClaim $claim)
    {
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        Speaker::firstOrCreate([
            'user_id' => $claimingUser->id,
            'slot_id' => $slot->id,
        ]);

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
