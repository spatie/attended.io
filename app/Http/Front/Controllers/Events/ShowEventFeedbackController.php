<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;
use App\Models\Slot;

class ShowEventFeedbackController
{
    public function show(Event $event)
    {
        $event->load([
            'reviews',
            'reviews.user',
        ]);

        return view('front.events.show-feedback', compact('event'));
    }
}
