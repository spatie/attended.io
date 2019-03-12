<?php

namespace App\Http\Front\Requests;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Rules\TrackIdBelongsToEventRule;
use App\Domain\Slot\Enums\SlotType;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Rules\DateBetweenRule;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\ValidationRules\Rules\Enum;

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
            'starts_at' => ['required', 'date', $dateBetweenRule],
            'type' => ['required', new Enum(SlotType::class)],
            'ends_at' => ['required', 'date', 'after:starts_at', $dateBetweenRule],
            'speakers' => 'required|array',
            'speakers.*.name' => ['required'],
            'speakers.*.email' => ['email'],
            'track_id' => ['required', new TrackIdBelongsToEventRule($this->event)],
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
