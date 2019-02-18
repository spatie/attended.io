<?php

namespace App\Models\Concerns;

use App\BusinessRules\CanBeReviewed;
use App\Domain\Review\Models\Review;
use App\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasReviews
{
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable')->orderBy('created_at', 'desc');
    }

    public function recalculateSummary()
    {
        $this->number_of_reviews = $this->reviews->count();
        $this->average_review_rating = round($this
            ->reviews
            ->filter(function (Review $review) {
                return $review->rating > 0;
            })
            ->avg('rating'));

        $this->save();

        return $this;
    }

    public function canBeReviewedBy(User $user): bool
    {
        if ($user->can('review')) {
            return false;
        }

        return (new CanBeReviewed($this, $user))->passes();
    }
}
