<?php

namespace App\Domain\Review\Actions;

use App\Domain\Review\Interfaces\Reviewable;

class RecalculateReviewStatisticsAction
{
    public function execute(Reviewable $reviewable)
    {
        $reviewable->recalculateSummary();
    }
}
