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

        $user = Attendance::getForUser(current_user(), $events);

        return view('front.events.recent-and-upcoming-index', compact('events', 'user'));
    }
}
