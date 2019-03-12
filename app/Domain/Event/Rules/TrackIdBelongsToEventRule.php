<?php

namespace App\Domain\Event\Rules;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use Illuminate\Contracts\Validation\Rule;

class TrackIdBelongsToEventRule implements Rule
{
    /** @var \App\Domain\Event\Rules\Event */
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function passes($attribute, $value)
    {
        if (empty($value)) {
            return true;
        }

        if (! $track = Track::find($value)) {
            return false;
        }

        return $track->event->id === $this->event->id;
    }

    public function message()
    {
        return 'The given track id does not belong to the right event.';
    }
}
