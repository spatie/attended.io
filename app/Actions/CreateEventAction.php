<?php

namespace App\Actions;

use App\Http\Front\Request\EventRequest;
use App\Models\Event;

class CreateEventAction
{
    public function execute(EventRequest $request): Event
    {
        /** @var \App\Models\Event $event */
        $event = Event::create($request->validated());

        $event->owners()->attach($request->user());

        return $event;
    }
}
