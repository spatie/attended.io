<?php

namespace App\Actions;

use App\Models\Interfaces\Reviewable;

class RecalculateReviewStatistics
{
    /** @var \App\Models\Interfaces\Reviewable */
    protected $reviewable;

    public function __construct(Reviewable $reviewable)
    {
        $this->reviewable = $reviewable;
    }

    public function execute()
    {
        $this->reviewable->recalculateSummary();
    }
}
