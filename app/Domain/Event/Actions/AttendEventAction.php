<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Attendee;
use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;

class AttendEventAction
{
    public function execute(User $user, Event $event): Attendee
    {
        $attendee =  Attendee::firstOrCreate([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);

        activity()
            ->performedOn($attendee->event)
            ->log("{$attendee->user->email} will attend {$attendee->event->name}");

        return $attendee;
    }
}
