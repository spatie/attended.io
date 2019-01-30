<?php

namespace App\Models\Presenters;

trait PresentsSlot
{
    public function startHour(): string
    {
        return $this->starts_at->format('H:i');
    }
}