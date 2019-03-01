<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Http\Front\Requests\UpdateSlotRequest;

class SlotsController
{
    public function index(Event $event)
    {
        return view('front.event-admin.slots.index', compact('event'));
    }

    public function create(Event $event)
    {
        $tracks = $event->tracks()->orderBy('order_column')->get();

        /*
        $speakers = $event->speakers
            ->map(function (Speaker $speaker) {
                return ['id' => $speaker->id, 'name' => $speaker->name, 'email' => $speaker->email];
            })
            ->toArray();
        */

        $speakers = [];

        $slot = new Slot();

        return view('front.event-admin.slots.create', compact('event', 'tracks', 'slot', 'speakers'));
    }

    public function store(Event $event)
    {
        dd(request()->all());
    }
}
