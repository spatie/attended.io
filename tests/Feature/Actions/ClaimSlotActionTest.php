<?php

namespace Tests\Feature\Actions;

use App\Domain\Slot\Actions\ClaimSlotAction;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use App\Domain\Slot\Notifications\SlotClaimedNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ClaimSlotActionTest extends TestCase
{
    /** @test */
    public function a_slot_can_be_claimed()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        $slot = factory(Slot::class)->create();

        factory(User::class, 3)->create()->each(function (User $user) use ($slot) {
            $slot->event->owners()->attach($user);
        });

        $this->assertFalse($user->isClaimingSlot($slot));

        (new ClaimSlotAction())->execute($user, $slot);

        $this->assertTrue($user->isClaimingSlot($slot));
        $this->assertFalse($user->owns($slot));
        $this->assertCount(3, $slot->event->owners);

        foreach ($slot->event->owners as $owner) {
            Notification::assertSentTo($owner, SlotClaimedNotification::class);
        }
    }
}
