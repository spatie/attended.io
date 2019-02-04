<?php

namespace App\Actions;

use App\Models\Attendence;
use App\Models\Event;
use App\Models\User;

class AttendEventAction
{
    public function execute(User $user, Event $event): Attendence
    {
        return Attendence::firstOrCreate([
            'user_id' => $user->id,
            'event_id' => $event->id
        ]);
    }
}