<?php

namespace App\Actions;

use App\Http\Front\Requests\UpdateEventRequest;
use App\Models\Event;

class CreateEventAction
{
    public function execute(UpdateEventRequest $request): Event
    {
        $event = Event::create($request->validated());

        $event->owners()->attach($request->user());

        return $event;
    }
}
