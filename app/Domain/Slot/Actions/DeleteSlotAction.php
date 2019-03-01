<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\Slot;

class DeleteSlotAction
{
    public function execute(Slot $slot)
    {
        $slot->delete();

        activity()
            ->performedOn($slot)
            ->log("Slot `{$slot->name}` has been deleted.");
    }
}
