<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class RecentAndUpcomingEventsListController
{
    public function index()
    {
        $events = Event::query()
            ->where('starts_at', '<=', now()->subDay(4))
            ->orderBy('starts_at')
            ->limit(10)
            ->get();

        return view('front.events.recent-and-upcoming-index', compact('events'));
    }
}
