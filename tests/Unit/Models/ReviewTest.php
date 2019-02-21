<?php

namespace Tests\Unit\Models;

use App\Domain\Review\Models\Review;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    /** @test */
    public function it_can_get_the_reviewable_type()
    {
        $review = factory(Review::class)->create();

        $this->assertTrue(in_array($review->reviewableType(), ['slot', 'event']));
    }
}
