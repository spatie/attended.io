<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;

class CreateSlotAction
{
    public function execute(Event $event, array $attributes): Slot
    {
        $slot = Slot::make(['event_id' => $event->id]);

        $slot = (new UpdateSlotAction())->execute($slot, $attributes);

        activity()
            ->performedOn($slot)
            ->log("Slot `{$slot->name}` was created.");

        return $slot;
    }
}
