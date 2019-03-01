<?php

namespace App\Http\Front\Requests;

class CreateSlotRequest extends UpdateSlotRequest
{
    public function authorized()
    {
        return $this->user()->can('adminster', $this->event());
    }
}
