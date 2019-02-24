<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\ApproveEventAction;
use App\Domain\Event\Models\Event;
use App\Domain\Event\Notifications\EventApprovedNotification;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ApproveEventActionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function it_can_approve_an_event()
    {
        $organizingUsers = factory(User::class, 3)->create();

        $event = factory(Event::class)->create();

        foreach ($organizingUsers as $organizingUser) {
            $event->organizingUsers()->attach($organizingUser);
        }

        $this->assertFalse($event->isApproved());

        (new ApproveEventAction())->execute($event);

        $this->assertTrue($event->isApproved());

        foreach ($organizingUsers as $organizingUser) {
            Notification::assertSentTo($organizingUser, EventApprovedNotification::class);
        }
    }


}