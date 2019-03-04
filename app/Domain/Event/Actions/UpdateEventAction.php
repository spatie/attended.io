<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;

class UpdateEventAction
{
    public function execute(Event $event, array $attributes): Event
    {
        $event->update($attributes);

        activity()
            ->performedOn($event)
            ->log("Event `{$event->name}` was updated");

        return $event;
    }
}
