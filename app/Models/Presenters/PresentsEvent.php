<?php

namespace App\Models\Presenters;

trait PresentsEvent
{
    public function timeSpan(): string
    {
        if ($this->starts_at->isSameDay($this->ends_at)) {
            return $this->starts_at->format('j F Y');
        }

        $timeSpan = $this->starts_at->format('j') . ' ';

        if (! $this->starts_at->isSameMonth($this->ends_at)) {
            $timeSpan .= $this->starts_at->format('F') . ' ';
        }

        if (! $this->starts_at->isSameYear($this->ends_at)) {
            $timeSpan .= $this->starts_at->format('Y') . ' ';
        }

        $timeSpan .= '- ';

        $timeSpan .= $this->ends_at->format('j F Y');

        return $timeSpan;
    }
}
