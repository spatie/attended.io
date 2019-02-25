<?php

namespace App\Domain\Event\Actions;

use App\Domain\Event\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PublishEventAction
{
    use AuthorizesRequests;

    public function execute(Event $event): Event
    {
        $this->authorize('publish', $event);

        $event->markAsPublished();

        return $event;
    }
}
