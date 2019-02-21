<?php

namespace App\Domain\Event\Exceptions;

use App\Domain\Event\Models\Track;
use Exception;

class CouldNotDeleteTrack extends Exception
{
    public static function trackHasSlots(Track $track)
    {
        return new static("Cannot update track `{$track->name}` because it still has slots.");
    }
}
