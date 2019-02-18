<?php

namespace App\Http\Front\Controllers\Events;

use App\Domain\Event\Actions\DoNotAttendEventAction;

class DoNotAttendEventController
{
    public function __invoke(Event $event, DoNotAttendEventAction $doNotAttendEventAction)
    {
        $doNotAttendEventAction->execute(auth()->user(), $event);

        return ok();
    }
}
