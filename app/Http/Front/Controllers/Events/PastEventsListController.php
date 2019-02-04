<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Attendance;
use App\Models\Event;

class PastEventsListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->where('ends_at', '<', now())
            ->orderBy('ends_at', 'desc')
            ->paginate();

        $currentUserAttendance = Attendance::getForUser(current_user(), collect($events->items()));

        return view('front.events.past-events-index', compact(
            'events',
            'currentUserAttendance'
        ));
    }
}
