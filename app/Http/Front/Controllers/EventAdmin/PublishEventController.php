<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Actions\PublishEventAction;
use App\Domain\Event\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PublishEventController
{
    use AuthorizesRequests;

    public function __invoke(Event $event)
    {
        $this->authorize('publish', $event);

        if ($event->isPublished()) {
            flash()->warning('This event was already published');

            return back();
        }

        (new PublishEventAction())->execute($event);

        flash()->success('The event has published. Everybody can now view it.');

        return back();
    }
}
