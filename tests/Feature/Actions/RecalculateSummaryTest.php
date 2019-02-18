<?php

namespace Tests\Feature\Actions;

use App\Domain\Review\Actions\RecalculateReviewStatisticsAction;
use App\Models\Review;
use App\Models\Slot;
use Tests\TestCase;

class RecalculateSummaryTest extends TestCase
{
    /** @test */
    public function it_can_recalculate_the_total_and_average_of_the_reviews()
    {
        $slot = factory(Slot::class)->create();

        $this
            ->review($slot, 4)
            ->review($slot, 6);

        (new RecalculateReviewStatisticsAction())->execute($slot);

        $this->assertEquals(2, $slot->number_of_reviews);
        $this->assertEquals(5, $slot->average_review_rating);
    }

    public function review(Slot $slot, int $rating)
    {
        factory(Review::class)->create([
            'reviewable_type' => get_class($slot),
            'reviewable_id' => $slot->id,
            'rating' => $rating,
        ]);


        return $this;
    }
}
