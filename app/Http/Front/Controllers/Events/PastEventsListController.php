<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class PastEventsListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->with('currentUserAttendance')
            ->where('ends_at', '<', now())
            ->orderBy('ends_at', 'desc')
            ->paginate();

        return view('front.events.past-events-index', compact('events'));
    }
}
