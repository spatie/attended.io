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
        $this->markAsPublished($event);

        $event->slots->each(function (Slot $slot) {
            (new SendInvitationToClaimSlotAction())->execute($slot);
        });

        return $event;
    }

    public function markAsPublished(Event $event)
    {
        $event->published_at = now();

        $event->save();
    }
}
