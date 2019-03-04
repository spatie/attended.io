<?php

namespace App\Http\Front\Controllers\Events;

use App\Domain\Event\Models\Event;

class AllEventsController
{
    public function __invoke()
    {
        $events = Event::query()
            ->upcomingOrPast(request())
            ->published()
            ->with('currentUserAttendee')
            ->orderBy('starts_at')
            ->paginate()
            ->appends(request()->all());

        return view('front.events.all-index', compact('events'));
    }
}
