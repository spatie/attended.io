<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\Slot\Actions\SendInvitationToClaimSlotAction;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SpeakerInvitationNotification;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendInvitationToClaimSlotActionTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    /** @var \App\Domain\Slot\Models\Speaker */
    protected $speaker;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        $this->event = factory(Event::class)->create();

        $this->slot = factory(Slot::class)->create([
            'event_id' => $this->event->id,
        ]);

        $this->speaker = factory(Speaker::class)->state('withoutUserAccount')->create([
            'slot_id' => $this->slot->id,
        ]);
    }

    /** @test */
    public function it_can_send_invitations_to_the_speakers_of_a_slot()
    {
        $this->assertFalse($this->speaker->hasBeenSentInvitation());

        (new SendInvitationToClaimSlotAction())->execute($this->slot);

        $this->assertTrue($this->speaker->refresh()->hasBeenSentInvitation());
        Notification::assertSentTo($this->speaker, SpeakerInvitationNotification::class);
    }

    /** @test */
    public function it_will_not_send_invitation_for_events_that_have_not_been_published_yet()
    {
        $this->event->update(['published_at' => null]);

        (new SendInvitationToClaimSlotAction())->execute($this->slot);

        $this->assertFalse($this->speaker->refresh()->hasBeenSentInvitation());

        Notification::assertNothingSent();
    }

    /** @test */
    public function it_will_not_send_the_invitation_twice()
    {
        foreach (range(1, 5) as $i) {
            (new SendInvitationToClaimSlotAction())->execute($this->slot);

            Notification::assertSentToTimes($this->speaker, SpeakerInvitationNotification::class, 1);
        }
    }

    /** @test */
    public function it_will_not_send_an_invitation_if_the_slot_has_already_been_claimed()
    {
        $this->speaker->update([
            'user_id' => factory(User::class)->create()->id,
        ]);

        (new SendInvitationToClaimSlotAction())->execute($this->slot);

        Notification::assertNothingSent();
    }
}
