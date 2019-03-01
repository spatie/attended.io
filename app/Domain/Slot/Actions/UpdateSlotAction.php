<?php

namespace App\Domain\Slot\Actions;

use App\Domain\Slot\Models\Slot;
use Carbon\Carbon;

class UpdateSlotAction
{
    public function execute(Slot $slot, array $attributes): Slot
    {
        $newSlot = ! $slot->exist;

        $slot->name = $attributes['name'];
        $slot->track_id = $attributes['track_id'];
        $slot->starts_at = Carbon::createFromFormat('Y-m-d H:i', $attributes['starts_at']);
        $slot->ends_at = Carbon::createFromFormat('Y-m-d H:i', $attributes['ends_at']);
        $slot->description = $attributes['description'];
        $slot->type = $attributes['type'];

        $slot->save();

        (new UpdateSpeakersAction)->execute($slot, $attributes['speakers']);

        if (! $newSlot) {
            activity()
                ->performedOn($slot)
                ->log("Slot `{$slot->name}` was updated.");
        }

        return $slot->refresh();
    }
}
