<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Notifications\SlotClaimedNotification;
use App\Domain\User\Models\User;

class ClaimSlotAction
{
    public function execute(User $claimingUser, Slot $slot)
    {
        $slot->claimingUsers()->attach($claimingUser);

        activity()
            ->performedOn($slot)
            ->log("{$claimingUser->email} is claming slot `{$slot->name}`");

        $slot->event->organizingUsers->each->notify(new SlotClaimedNotification($claimingUser, $slot));
    }
}
