<?php

namespace App\Actions;

use App\Mail\SlotOwnershipClaimRejectedMail;
use App\Models\SlotOwnershipClaim;
use Illuminate\Support\Facades\Mail;

class RejectSlotOwnershipClaimAction
{
    public function execute(SlotOwnershipClaim $claim)
    {
        $claimingUser = $claim->user;
        $slot = $claim->slot;

        $claim->delete();

        Mail::to($claimingUser->email)->queue(new SlotOwnershipClaimRejectedMail($claimingUser, $slot));
    }
}
