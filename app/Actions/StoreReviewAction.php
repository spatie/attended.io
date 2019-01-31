<?php

namespace App\Actions;

use App\Models\Interfaces\Reviewable;

class StoreReviewAction
{
    /** @var \App\Actions\User */
    protected $user;

    /** @var \App\Models\Interfaces\Reviewable */
    protected $reviewable;

    /** @var array */
    protected $reviewAttributes;

    public function __construct(User $user, Reviewable $reviewable, array $reviewAttributes)
    {
        $this->user = $user;
        $this->reviewable = $reviewable;
        $this->reviewAttributes = $reviewAttributes;
    }

    public function execute()
    {
        $this->reviewable->reviews()->create([
            'user_id' => $this->user->id,
            'rating' => $reviewAttributes['rating'] ?? null,
            'remarks' => $reviewAttributes['remarks'] ?? null,
        ]);

        (new RecalculateReviewStatistics($this->reviewable))->execute();
    }
}
