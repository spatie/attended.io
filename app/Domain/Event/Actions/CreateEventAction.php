<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use App\Http\Front\Requests\UpdateEventRequest;

class CreateEventAction
{
    public function execute(User $organizingUser, array $attributes): Event
    {
        $event = Event::create($attributes);

        $event->organizingUsers()->attach($organizingUser);

        activity()->log("Event `{$event->name}` was created by {$organizingUser}");

        return $event;
    }
}
