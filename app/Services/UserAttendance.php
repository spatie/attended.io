<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Event;

class UserAttendance
{
    /** @var \Illuminate\Database\Eloquent\Collection  */
    protected $attendances;

    public function __construct(User $user, Events $events)
    {
        $this->attendances = Attendance::query()
            ->where('user_id', $user->id)
            ->whereIn('event_id', $events->pluck('id')->toArray())
            ->get();
    }

    public function attends(Event $event): bool
    {
        return $this->attendances->contains(function (Attendance $attendance) use ($event) {
            return $attendance->event->id === $event->id;
        });
    }
}
