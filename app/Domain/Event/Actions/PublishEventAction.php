<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Actions\SendInvitationToClaimSlotAction;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;

class PublishEventAction
{
    public function execute(User $user, Event $event): Event
    {
        $event->markAsPublished();

        $event->slots->each(function (Slot $slot) {
            (new SendInvitationToClaimSlotAction())->execute($slot);
        });

        return $event;
    }
}
