<?php

namespace App\Http\Front\Controllers\Events;

use App\Models\Event;
use App\Models\Slot;

class ShowEventController
{
    public function show(Event $event)
    {
        $slotsGroupedByDay = $event->slots
            ->sortBy(function (Slot $slot) {
                return $slot->starts_at->format('YmdHis') . '-' . optional($slot->track)->id;
            })
            ->groupBy(function (Slot $slot) {
                return $slot->starts_at->format('Ymd');
            });

        return view('front.events.show', compact('event', 'slotsGroupedByDay'));
    }
}
