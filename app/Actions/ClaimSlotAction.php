<?php

namespace App\Actions;

use App\Mail\ReviewSlotClaimMail;
use App\Models\PendingOwnership;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ClaimSlotAction
{
    public function execute(User $claimingUser, Slot $slot)
    {
        $slot->claimingUsers()->attach($claimingUser);

        $eventOwnerEmails = $slot->event->owners->pluck('email')->toArray();

        Mail::to($eventOwnerEmails)->queue(new ReviewSlotClaimMail($claimingUser, $slot));
    }
}
