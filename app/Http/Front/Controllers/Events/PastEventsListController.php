<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class PastEventsListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->where('ends_at', '<', now())
            ->orderBy('ends_at')
            ->get();

        return view('front.events.past-events-index', compact('events'));

    }
}
