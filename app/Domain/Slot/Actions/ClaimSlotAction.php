<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SlotClaimedNotification;
use App\Domain\User\Models\User;

class ClaimSlotAction
{
    public function execute(User $claimingUser, Slot $slot)
    {
        $slot->claimWillBeApprovedImmediatelyFor($claimingUser)
            ? $this->attachUserToSlot($claimingUser, $slot)
            : $this->createNewClaim($claimingUser, $slot);


        $this->createNewClaim($claimingUser, $slot);
    }

    protected function attachUserToSlot(User $claimingUser, Slot $slot)
    {
        $speaker = Speaker::query()
            ->where('email', $claimingUser->email)
            ->where('slot_id', $slot->id)
            ->first();

        $speaker->user_id = $claimingUser->id;
        $speaker->save();

    }

    protected function createNewClaim(User $claimingUser, Slot $slot)
    {
        $slot->claimingUsers()->attach($claimingUser);

        activity()
            ->performedOn($slot)
            ->log("{$claimingUser->email} is claming slot `{$slot->name}`");

        $slot->event->organizingUsers->each->notify(new SlotClaimedNotification($claimingUser, $slot));
    }


}
