<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;

class DeleteEventAction
{
    public function execute(Event $event)
    {
        $event->delete();

        activity()
            ->performedOn($event)
            ->log("Event `{$event->name}` has been deleted.");
    }
}
