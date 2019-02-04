<?php

namespace App\Http\Front\Controllers\Events;

use App\Actions\AttendEventAction;

class AttendEventController
{
    public function __invoke(Event $event, AttendEventAction $attendEventAction)
    {
        $attendEventAction->execute(current_user(), $event);

        return ok();
    }
}
