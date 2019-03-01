<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use App\Domain\Event\Notifications\EventCreatedNotification;
use App\Domain\User\Models\User;

class CreateEventAction
{
    public function execute(User $organizingUser, array $attributes): Event
    {
        $event = Event::create($attributes);

        Track::create([
           'event_id' => $event->id,
           'name' => 'Main',
        ]);

        $event->organizingUsers()->attach($organizingUser);

        activity()->log("Event `{$event->name}` was created by {$organizingUser}");

        if ($organizingUser->can_publish_events_immediately) {
            (new ApproveEventAction())->execute($event);
        } else {
            User::admin()->get()->each->notify(new EventCreatedNotification($event));
        }

        return $event;
    }
}
