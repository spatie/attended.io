<?php

namespace App\Http\Front\Controllers\Events;

class PastEventsListController
{
    public function index()
    {
        $events = Event::query()
            ->where('ends_at', '<', now())
            ->orderBy('ends_at')
            ->get();
    }
}
