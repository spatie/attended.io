<?php

namespace App\Actions;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\User;

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
