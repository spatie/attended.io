<?php

namespace App\Actions;

use App\Http\Front\Request\UpdateEventRequest;
use App\Models\Event;

class CreateEventAction
{
    public function execute(UpdateEventRequest $request): Event
    {
        /** @var \App\Models\Event $event */
        $event = Event::create($request->validated());

        $event->owners()->attach($request->user());

        return $event;
    }
}
