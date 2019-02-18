<?php

namespace Tests\Unit\Policies\Review;

use App\Models\Review;

class CreateReviewPolicyTest
{
    /** @test */
    public function a_unverified_user_cannot_create_a_review()
    {
        $unverifiedUser = factory(User::class)->state('unverified-email')->create();

        $this->assertFalse($unverifiedUser->can('create', ));
    }


}