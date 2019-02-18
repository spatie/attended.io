<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Attendance;
use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;

class AttendEventAction
{
    public function execute(User $user, Event $event): Attendance
    {
        $attendance =  Attendance::firstOrCreate([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);

        activity()
            ->performedOn($attendance->event)
            ->log("{$attendance->user->email} will attend {$attendance->event->name}");

        return $attendance;
    }
}
