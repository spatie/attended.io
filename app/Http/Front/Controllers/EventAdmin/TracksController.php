<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Models\Event;

class TracksController
{
    public function index(Event $event)
    {
        return view('front.event-admin.tracks.index', compact('event'));
    }
}
