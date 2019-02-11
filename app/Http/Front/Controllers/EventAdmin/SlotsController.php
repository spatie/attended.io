<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Models\Event;

class SlotsController
{
    public function index(Event $event)
    {
        return view('front.event-admin.slots.index', compact('event'));
    }
}
