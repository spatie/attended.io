<?php

namespace App\Models\Concerns;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasReviews
{
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
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
}
