<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class AllEventsController
{
    public function __invoke()
    {
        $events = Event::query()
            ->published()
            ->with('currentUserAttendance')
            ->where('starts_at', '>=', now()->subDay(4))
            ->orderBy('starts_at')
            ->paginate();

        return view('front.events.all-index', compact('events'));
    }
}
