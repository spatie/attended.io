<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;

class SlotsController
{
    public function index(Event $event)
    {
        return view('front.event-admin.slots.index', compact('event'));
    }

    public function create(Event $event)
    {
        $tracks = $event->tracks()->orderBy('order_column')->get();

        $slot = new Slot();

        return view('front.event-admin.slots.create', compact('event', 'tracks', 'slot'));
    }
}
