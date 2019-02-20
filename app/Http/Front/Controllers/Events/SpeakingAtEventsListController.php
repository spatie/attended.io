<?php

namespace App\Http\Front\Controllers\Events;

use App\Domain\Event\Models\Event;

class SpeakingAtEventsListController
{
    public function __invoke()
    {
        $events = Event::query()
            ->published()
            ->hasSlotWithSpeaker(auth()->user())
            ->orderBy('starts_at', 'desc')
            ->paginate()
            ->appends(request()->all());

        return view('front.events.speaking-at-events-index', compact('events'));
    }
}
