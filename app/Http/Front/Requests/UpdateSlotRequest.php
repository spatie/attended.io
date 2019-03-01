<?php

namespace App\Http\Front\Requests;

use App\Domain\Event\Rules\TrackIdBelongsToEvent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSlotRequest extends FormRequest
{


    public function rules()
    {
        return [
            'speakers.*.name' => ['required'],
            'speakers.*.email' => ['email'],

            'tracks.*.id' => [new TrackIdBelongsToEvent($this->event)],
        ];
    }
}
