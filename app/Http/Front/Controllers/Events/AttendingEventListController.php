<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class AttendingEventListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->published()
            ->hasAttendee(current_user())
            ->orderBy('starts_at', 'desc')
            ->paginate()
            ->appends(request()->all());

        return view('front.events.attending-index', compact('events'));
    }
}
