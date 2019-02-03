<?php

namespace App\Http\Front\Controllers\Slots;

use App\Models\Slot;

class ShowSlotController
{
    public function __invoke(Slot $slot)
    {
        return view('front.slots.show', compact('slot'));
    }
}
