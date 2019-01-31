<?php

namespace App\Actions;

use App\Models\Interfaces\Reviewable;

class RecalculateReviewStatistics
{
    public function execute(Reviewable $reviewable)
    {
        $reviewable->recalculateSummary();
    }
}
