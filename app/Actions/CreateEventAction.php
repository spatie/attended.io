<?php

namespace App\Actions;

use App\Http\Front\Request\EventRequest;
use App\Models\Event;

class CreateEventAction
{
    public function execute(EventRequest $eventRequest): Event
    {
        return Event::create($eventRequest->validated());
    }
}
