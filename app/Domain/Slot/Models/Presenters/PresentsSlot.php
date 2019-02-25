<?php

namespace App\Domain\Slot\Models\Presenters;

use App\Domain\Slot\Models\Speaker;

trait PresentsSlot
{
    public function startHour(): string
    {
        return $this->starts_at->format('H:i');
    }

    public function speakersAsString(): string
    {
        return $this
            ->speakers
            ->map(function (Speaker $speaker) {
                if ($speaker->user) {
                    $showRoute = route('users.show', $speaker->user);

                    return "<a href=\"{$showRoute}\">{$speaker->user->name}}</a>";
                }

                return $speaker->name;
            })
            ->join(', ', ' and ');
    }
}
