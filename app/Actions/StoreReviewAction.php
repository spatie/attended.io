<?php

namespace App\Actions;

use App\Models\Interfaces\Reviewable;
use App\Models\User;

class StoreReviewAction
{
    public function execute(User $user, Reviewable $reviewable, array $reviewAttributes)
    {
        $reviewable->reviews()->create([
            'user_id' => $user->id,
            'rating' => $reviewAttributes['rating'] ?? null,
            'remarks' => $reviewAttributes['remarks'] ?? null,
        ]);

        (new RecalculateReviewStatisticsAction())->execute($reviewable);
    }
}
