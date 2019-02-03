<?php

namespace App\Actions;

use App\Mail\ReviewSlotClaim;
use App\Models\PendingOwnership;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ClaimSlotAction
{
    public function execute(User $user, Slot $slot)
    {
        $pendingOwnership = PendingOwnership::create([
            'user_id' => $user->id,
            'ownable_type' => get_class($slot),
            'ownable_id' => $slot->id,
        ]);

        $eventOwnerEmails = $slot->event->owners->pluck('email')->toArray();

        Mail::to($eventOwnerEmails)->queue(new ReviewSlotClaim($pendingOwnership));
    }
}
