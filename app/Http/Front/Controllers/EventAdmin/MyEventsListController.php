<?php

namespace App\Http\Front\Controllers\EventAdmin;

class MyEventsListController
{
    public function __invoke()
    {
        $events = current_user()->events()->paginate();

        return view('front.event-admin.my-events-index', compact('events'));
    }
}
