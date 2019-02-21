<?php

namespace App\Domain\Event\Exceptions;

use App\Domain\Event\Models\Event;
use Exception;

class CouldNotUpdateTrack extends Exception
{
    public static function trackDoesNotExist(int $trackId)
    {
        return new static("Cannot update track id `{$trackId}` because no track exists with that id.");
    }

    public static function trackDoesNotBelongToEvent(int $trackId, Event $event)
    {
        return new static("Cannot update track id `{$trackId}` because it does not belong to event id `{$event->id}`.");
    }
}
