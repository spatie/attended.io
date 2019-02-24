<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;

class PublishEventAction
{
    public function execute(Event $event): Event
    {
        $event->markAsPublished();

        return $event;
    }
}
