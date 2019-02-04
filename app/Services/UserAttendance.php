<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Collection;

class UserAttendance
{
    /** @var \Illuminate\Support\Collection */
    protected $attendances;

    public function __construct(?User $user, Collection $events)
    {
        $this->attendances = is_null($user)
            ? collect()
            : Attendance::query()
                ->where('user_id', $user->id)
                ->whereIn('event_id', $events->pluck('id')->toArray())
                ->get();
    }

    public function exists(Event $event): bool
    {
        return $this->attendances->contains(function (Attendance $attendance) use ($event) {
            return $attendance->event->id === $event->id;
        });
    }
}
