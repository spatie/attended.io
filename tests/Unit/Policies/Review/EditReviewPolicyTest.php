<?php

namespace Tests\Unit\Policies\Review;

use App\Domain\Review\Models\Review;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EditReviewPolicyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setNow(2019, 1, 1, 13, 0, 0);
    }

    /** @test */
    public function a_review_can_be_edited_by_the_user_that_created_it()
    {
        $review = factory(Review::class)->create();

        $this->assertTrue($review->user->can('edit', $review));

        $anotherUser = factory(User::class)->create();

        $this->assertFalse($anotherUser->can('edit', $review));
    }

    /** @test */
    public function when_a_review_is_older_than_30_minutes_it_cannot_be_edited_anymore()
    {
        $review = factory(Review::class)->create();

        $this->progressTime(29);
        $this->assertTrue($review->user->can('edit', $review));

        $this->progressTime(1);
        $this->assertFalse($review->user->can('edit', $review));
    }

    public function a_review_of_an_event_can_be_edited_by_the_owner_of_the_event_the_review_belongs_to()
    {
        $event = factory(Event::class)->create();

        $review = factory(Review::class)->create([
            'reviewable_id' => $event->id,
            'reviewable_type' => get_class($event)
        ]);

        $user = factory(User::class)->create();

        $this->assertFalse($user->can('edit', $review));

        $event->organizingUsers()->attach($user);
        $this->assertTrue($user->can('edit', $review->refresh()));

        $this->progressTime(30);
        $this->assertTrue($user->can('edit', $review->refresh()));
    }

    /** @test */
    public function a_review_for_a_slot_can_be_edited_by_the_owner_of_the_event_that_has_that_slot()
    {
        $slot = factory(Slot::class)->create();

        $review = factory(Review::class)->create([
            'reviewable_id' => $slot->id,
            'reviewable_type' => get_class($slot)
        ]);

        $user = factory(User::class)->create();

        $this->assertFalse($user->can('edit', $review));

        $slot->event->organizingUsers()->attach($user);
        $this->assertTrue($user->can('edit', $review->refresh()));

        $this->progressTime(30);
        $this->assertTrue($user->can('edit', $review->refresh()));
    }
}
