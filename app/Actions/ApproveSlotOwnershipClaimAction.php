<?php

namespace App\Actions;

use App\Mail\SlotOwnershipClaimApprovedMail;
use App\Models\SlotOwnershipClaim;
use Illuminate\Support\Facades\Mail;

class ApproveSlotOwnershipClaimAction
{
    public function execute(SlotOwnershipClaim $claim)
    {
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $slot->owners()->attach($claimingUser);

        $claim->delete();

        Mail::to($claimingUser->email)->queue(new SlotOwnershipClaimApprovedMail($claimingUser, $slot));
    }
}
