<?php

namespace App\Http\Front\Controllers;

use App\Models\Slot;

class SlotsController
{
    public function show(Slot $slot)
    {
        return view('front.slots.show', compact('slot'));
    }
}
