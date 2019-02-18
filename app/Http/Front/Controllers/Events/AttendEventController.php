<?php

namespace App\Http\Front\Controllers\Events;

use App\Domain\Event\Actions\AttendEventAction;

class AttendEventController
{
    public function __invoke(Event $event, AttendEventAction $attendEventAction)
    {
        $attendEventAction->execute(auth()->user(), $event);

        return ok();
    }
}
