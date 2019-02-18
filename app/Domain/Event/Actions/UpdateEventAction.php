<?php

namespace App\Domain\Event\Actions;

use App\Http\Front\Requests\UpdateEventRequest;
use App\Domain\Event\Models\Event;

class UpdateEventAction
{
    public function execute(Event $event, UpdateEventRequest $request): Event
    {
        $event->update($request->validated());

        activity()
            ->performedOn($event)
            ->log("Event `{$event->name}` was updated");

        return $event;
    }
}
