<?php

namespace App\Http\Front\Requests;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Rules\TrackIdBelongsToEvent;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Rules\DateBetweenRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSlotRequest extends FormRequest
{
    public function authorized()
    {
        return $this->user()->can('adminster', $this->slot());
    }

    public function rules()
    {
        $dateBetweenRule = new DateBetweenRule(
            $this->event()->starts_at,
            $this->event()->ends_at,
            );

        return [
            'name' => 'required',
            'description' => '',
            'starts_at' => ['required', $dateBetweenRule],
            'ends_at' => ['required', 'after:starts_at', $dateBetweenRule],
            'speakers.*.name' => ['required'],
            'speakers.*.email' => ['email'],
            'tracks_id' => [new TrackIdBelongsToEvent($this->event)],
        ];
    }

    public function event(): Event
    {
        return $this->route('event');
    }

    private function slot(): Slot
    {
        return $this->route('slot');
    }
}
