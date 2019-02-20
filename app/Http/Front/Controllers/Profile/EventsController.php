<?php

namespace App\Http\Front\Controllers\Profile;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;

class EventsController
{
    public function __invoke(User $user)
    {
        $events = Event::query()
            ->published()
            ->hasAttendee(auth()->user())
            ->orderBy('starts_at', 'desc')
            ->paginate();

        return view('front.profile.events', compact('user', 'events'));
    }
}
