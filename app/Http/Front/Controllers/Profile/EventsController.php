<?php

namespace App\Http\Front\Controllers\Profile;

use App\Domain\User\Models\User;

class EventsController
{
    public function __invoke(User $user)
    {
        $events = [];

        return view('front.profile.events', compact('user', 'events'));
    }
}
