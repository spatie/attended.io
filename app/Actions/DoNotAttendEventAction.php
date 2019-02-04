<?php

namespace App\Actions;

use App\Models\Attendence;
use App\Models\Event;
use App\Models\User;

class DoNotAttendEventAction
{
    public function execute(User $user, Event $event)
    {
        Attendence::query()
            ->where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->delete();
    }
}
