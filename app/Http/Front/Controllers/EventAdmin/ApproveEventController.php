<?php

namespace App\Http\Front\Controllers\EventAdmin;

use App\Domain\Event\Actions\ApproveEventAction;
use App\Domain\Event\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApproveEventController
{
    use AuthorizesRequests;

    public function __invoke(Event $event)
    {
        $this->authorize('approve', $event);

        if ($event->isApproved()) {
            flash()->warning('The event was already approved');

            return back();
        }

        (new ApproveEventAction())->execute($event);

        flash()->success('The event has approved. The organisers can now choose to publish it.');

        return back();
    }
}