<?php

namespace App\Http\Front\Controllers\EventAdmin;

class MyEventsListController
{
    public function __invoke()
    {
        return view('front.event-admin.my-events-index');
    }
}
