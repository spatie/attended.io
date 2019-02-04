<?php

namespace App\Http\Front\Controllers\Slots;

use App\Models\Slot;

class ShowSlotController
{
    public function __invoke(Slot $slot)
    {
        $slot->load([
            'reviews',
            'reviews.user',
        ]);

        return view('front.slots.show', compact('slot'));
    }
}
