<?php

namespace App\Domain\Review\Actions;

use App\Models\Interfaces\Reviewable;

class RecalculateReviewStatisticsAction
{
    public function execute(Reviewable $reviewable)
    {
        $reviewable->recalculateSummary();
    }
}
