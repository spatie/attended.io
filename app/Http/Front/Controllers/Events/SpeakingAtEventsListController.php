<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;

class SpeakingAtEventsListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->hasSlotWithSpeaker(current_user())
            ->orderBy('starts_at', 'desc')
            ->paginate();

        return view('front.events.speaking-at-events-index', compact('events'));
    }
}
