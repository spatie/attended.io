<?php

namespace App\Domain\Slot\Rules;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Models\Track;
use Illuminate\Contracts\Validation\Rule;

class SpeakerIdBelongsToSlot implements Rule
{
    /** @var \App\Domain\Slot\Rules\Slot */
    protected $slot;

    public function __construct(Slot $slot)
    {
        $this->slot = $slot;
    }

    public function passes($attribute, $value)
    {
        if (empty($value)) {
            return true;
        }

        if (! $speaker = Speaker::find($value)) {
            return false;
        }

        return $speaker->slot->id === $this->slot->id;
    }

    public function message()
    {
        return 'The given speaker id does not belong to the right slot.';
    }
}
