<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class AllEventsController
{
    public function __invoke()
    {
        $events = Event::query()
            ->upcomingOrPast(request())
            ->published()
            ->with('currentUserAttendance')
            ->orderBy('starts_at')
            ->paginate();

        return view('front.events.all-index', compact('events'));
    }
}
