<?php

namespace App\Domain\Event\Exceptions;

use App\Domain\Slot\Actions\Slot;
use App\Domain\Slot\Models\Speaker;
use Exception;

class CouldNotUpdateSpeaker extends Exception
{
    public static function speakerDoesNotExist(int $speakerId)
    {
        return new static("Cannot update speaker id `{$speakerId}` because no speaker exists with that id.");
    }

    public static function speakerDoesNotBelongToSlot(Speaker $speaker, Slot $slot)
    {
        return new static("Cannot update speaker id `{$speaker->id}` because it does not belong to slot id `{$slot->id}`.");
    }
}
