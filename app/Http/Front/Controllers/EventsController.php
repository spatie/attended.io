<?php

namespace App\Http\Front\Controllers;

use App\Models\Event;

class EventsController
{
    public function show(Event $event)
    {
        return view('front.events.show', compact('event'));
    }
}