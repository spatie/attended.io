<?php

namespace App\Http\Front\Controllers;

use App\Models\Event;

class HomeController
{
    public function index()
    {
        $events = Event::query()
            ->where('starts_at', '<=', now()->subDay(4))
            ->orderBy('starts_at')
            ->limit(10)
            ->get();

        return view('front.home.index', compact('events'));
    }
}
