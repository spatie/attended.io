<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\PublishEventAction;
use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Notifications\SpeakerInvitationNotification;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PublishEventActionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function it_can_publish_an_event()
    {
        $organizingUser = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'approved_at' => now(),
            'published_at' => null,
        ]);
        $event->organizingUsers()->attach($organizingUser);

        $this->addSlots($event, 3);

        $this->assertFalse($event->isPublished());

        (new PublishEventAction())->execute($organizingUser, $event);

        $this->assertTrue($event->isPublished());
        Notification::assertSentTo(
            $event->slots->first()->speakers->first(),
            SpeakerInvitationNotification::class,
            );
    }

    protected function addSlots(Event $event, int $numberOfSlots = 1)
    {
        foreach (range(1, $numberOfSlots) as $i) {
            $slot = factory(Slot::class)->create([
                'event_id' => $event->id,
            ]);

            factory(Speaker::class)->create([
                'slot_id' => $slot->id,
                'user_id' => null,
            ]);
        }
    }
}
