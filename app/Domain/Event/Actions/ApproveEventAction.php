<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventApprovedNotification;
use App\Domain\User\Models\User;

class ApproveEventAction
{
    public function execute(Event $event)
    {
        $event->markAsApproved();

        $event->organizingUsers->each(function (User $user) use ($event) {
            $user->notify(new EventApprovedNotification($event));
        });

        activity()
            ->performedOn($event)
            ->log("Event `{$event->name}` was approved");
    }
}
