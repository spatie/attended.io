<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;

class PublishEventAction
{
    public function execute(User $user, Event $event): Event
    {
        $event->markAsPublished();

        return $event;
    }
}
