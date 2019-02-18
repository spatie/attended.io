<?php

namespace Tests\Unit\Policies\Review;

use App\Models\Event;
use App\Models\Review;
use App\Models\Slot;
use App\Domain\User\Models\User;
use Tests\TestCase;

class DeleteReviewPolicyTest extends TestCase
{
    /** @test */
    public function the_creator_of_the_review_can_delete_it()
    {
        $review = factory(Review::class)->create();
        $this->assertTrue($review->user->can('delete', $review));

        $anotherUser = factory(User::class)->create();
        $this->assertFalse($anotherUser->can('delete', $review));
    }

    /** @test */
    public function a_review_for_an_event_can_be_deleted_by_the_owner_of_the_event()
    {
        $event = factory(Event::class)->create();

        $review = factory(Review::class)->create([
            'reviewable_id' => $event->id,
            'reviewable_type' => get_class($event)
        ]);

        $user = factory(User::class)->create();

        $this->assertFalse($user->can('delete', $review));

        $event->owners()->attach($user);
        $this->assertTrue($user->can('delete', $review->refresh()));
    }

    /** @test */
    public function a_review_for_a_slot_can_be_deleted_by_the_owner_of_the_event_that_has_that_slot()
    {
        $slot = factory(Slot::class)->create();

        $review = factory(Review::class)->create([
            'reviewable_id' => $slot->id,
            'reviewable_type' => get_class($slot)
        ]);

        $user = factory(User::class)->create();

        $this->assertFalse($user->can('delete', $review));

        $slot->event->owners()->attach($user);
        $this->assertTrue($user->can('delete', $review->refresh()));
    }
}
