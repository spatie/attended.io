<?php

namespace App\Actions;

use App\Models\Interfaces\Reviewable;

class RecalculateReviewStatisticsAction
{
    public function execute(Reviewable $reviewable)
    {
        $reviewable->recalculateSummary();
    }
}
