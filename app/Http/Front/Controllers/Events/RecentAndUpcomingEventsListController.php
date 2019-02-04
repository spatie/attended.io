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

        $attendances = Attendance::query()
            ->forEvents($events->items())
            ->byUser(current_user())
            ->get();

        return view('front.events.recent-and-upcoming-index', compact('events', 'attendances'));
    }
}
