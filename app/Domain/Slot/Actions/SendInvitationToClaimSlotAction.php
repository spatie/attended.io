<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SpeakerInvitationNotification;

class SendInvitationToClaimSlotAction
{
    public function execute(Slot $slot)
    {
        if (! $slot->event->isPublished()) {
            return;
        }

        $slot->speakers
            ->reject(function (Speaker $speaker) {
                return $speaker->hasBeenSentInvitation();
            })
            ->reject(function (Speaker $speaker) {
                return $speaker->user;
            })
            ->each(function (Speaker $speaker) use ($slot) {
                $speaker->notify(new SpeakerInvitationNotification($slot));

                $speaker->markAsInvitationSent();
            });
    }
}
