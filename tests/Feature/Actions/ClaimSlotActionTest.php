<?php

namespace Tests\Feature\Actions;

use App\Actions\ClaimSlotAction;
use App\Mail\ReviewSlotClaim;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ClaimSlotActionTest extends TestCase
{
    /** @test */
    public function a_slot_can_be_claimed()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $slot = factory(Slot::class)->create();

        factory(User::class, 3)->create()->each(function (User $user) use ($slot) {
            $slot->event->owners()->attach($user);
        });

        $this->assertFalse($user->isClaimingSlot($slot));

        (new ClaimSlotAction())->execute($user, $slot);

        $this->assertTrue($user->isClaimingSlot($slot));
        $this->assertFalse($user->owns($slot));

        Mail::assertQueued(ReviewSlotClaim::class, function (ReviewSlotClaim $mail) use ($slot) {
            foreach ($slot->event->owners as $eventOwner) {
                if (! $mail->hasTo($eventOwner->email)) {
                    return false;
                }
            }

            return true;
        });
    }
}
