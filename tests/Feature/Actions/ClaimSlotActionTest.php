<?php

namespace Tests\Feature\Actions;

use App\Domain\Slot\Actions\ClaimSlotAction;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SlotClaimedNotification;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ClaimSlotActionTest extends TestCase
{
    /** @var \App\Domain\User\Models\User */
    protected $claimingUser;

    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        $this->claimingUser = factory(User::class)->create();
        $this->slot = factory(Slot::class)->create();

        factory(User::class, 3)->create()->each(function (User $organizingUser) {
            $this->slot->event->organizingUsers()->attach($organizingUser);
        });
    }

    /** @test */
    public function a_slot_can_be_claimed()
    {
        $this->assertFalse($this->claimingUser->isClaimingSlot($this->slot));

        (new ClaimSlotAction())->execute($this->claimingUser, $this->slot);

        $this->assertTrue($this->claimingUser->isClaimingSlot($this->slot));
        $this->assertFalse($this->claimingUser->isSpeaker($this->slot));
        $this->assertCount(3, $this->slot->event->organizingUsers);

        foreach ($this->slot->event->organizingUsers as $organizingUser) {
            Notification::assertSentTo($organizingUser, SlotClaimedNotification::class);
        }
    }

    public function a_claim_will_automatically_be_approved_if_there_is_a_speaker_with_the_same_email_as_the_claiming_user()
    {
        Speaker::create([
            'slot_id' => $this->slot->id,
            'email' => $this->claimingUser->email,
        ]);

        (new ClaimSlotAction())->execute($this->claimingUser, $this->slot);

        $this->assertTrue($this->claimingUser->isSpeaker($this->slot));

        Notification::assertNothingSent();
    }
}
