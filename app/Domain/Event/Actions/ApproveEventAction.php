<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;

class ApproveEventAction
{
    public function execute(Event $event)
    {
        $event->markAsApproved();

        activity()
            ->performedOn($event)
            ->log("Event `{$event->name}` was approved");
    }
}
