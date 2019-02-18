<?php

namespace App\Http\Front\Controllers\Events;

use App\Actions\DoNotAttendEventAction;

class DoNotAttendEventController
{
    public function __invoke(Event $event, DoNotAttendEventAction $doNotAttendEventAction)
    {
        $doNotAttendEventAction->execute(auth()->user(), $event);

        return ok();
    }
}
