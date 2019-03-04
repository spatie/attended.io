<?php

namespace Tests\Unit\Models;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\User\Models\User;
use Tests\TestCase;

class SlotTest extends TestCase
{
    /** @test */
    public function it_can_determine_wheter_a_claim_should_be_approved_immediately()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        /** @var Slot $slot */
        $slot = factory(Slot::class)->create();

        $this->assertFalse($slot->claimWillBeApprovedImmediatelyFor($user));

        factory(Speaker::class)->create(['email' => $user->email]);

        $slot->refresh();

        $this->assertTrue($slot->claimWillBeApprovedImmediatelyFor($user));

        $anotherUser = factory(User::class)->create();
        $this->assertFalse($slot->claimWillBeApprovedImmediatelyFor($anotherUser));
    }
}
