<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Attendance;
use App\Models\Event;

class RecentAndUpcomingEventsListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->where('starts_at', '>=', now()->subDay(4))
            ->orderBy('starts_at')
            ->paginate();

        $currentUserAttendance = Attendance::getForUser(current_user(), collect($events->items()));

        return view('front.events.recent-and-upcoming-index', compact(
            'events',
            'currentUserAttendance'
        ));
    }
}
