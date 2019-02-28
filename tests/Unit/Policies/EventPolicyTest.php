<?php

namespace Tests\Unit\Policies;

use App\Domain\Event\Actions\ApproveEventAction;
use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EventPolicyTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    /** @var \App\Domain\User\Models\User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->setNow(2019, 1, 1, 13, 0, 0);

        $this->event = factory(Event::class)->create([
            'starts_at' => now()->subDays(3),
            'ends_at' => now(),
        ]);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function an_owner_of_event_is_allowed_to_administer_it()
    {
        $this->assertFalse($this->user->can('administer', $this->event));

        $this->event->organizingUsers()->attach($this->user);
        $this->event->refresh();
        $this->user->refresh();

        $this->assertTrue($this->user->can('administer', $this->event));
    }

    /** @test */
    public function an_owner_a_another_event_cannot_administer_this_event()
    {
        $anotherEvent = factory(Event::class)->create();

        $anotherEvent->organizingUsers()->attach($this->user);
        $this->event->refresh();

        $this->assertFalse($this->user->can('administer', $this->event));
    }

    /** @test */
    public function an_admin_can_administer_all_events()
    {
        $this->user->admin = 1;
        $this->user->save();

        $this->assertTrue($this->user->can('administer', $this->event));
    }

    /** @test */
    public function an_event_cannot_be_published_if_it_was_not_approved()
    {
        $event = factory(Event::class)->state('unapproved')->create();
        $event->organizingUsers()->attach($this->user);

        $this->assertFalse($this->user->can('publish', $event));

        (new ApproveEventAction())->execute($event);

        $this->assertTrue($this->user->can('publish', $event));
    }

    /** @test */
    public function an_event_cannot_published_by_another_user()
    {
        $event = factory(Event::class)->state('approved')->create();
        $event->organizingUsers()->attach($this->user);

        $this->assertTrue($this->user->can('publish', $event));

        $anotherUser = factory(User::class)->create();
        $this->assertFalse($anotherUser->can('publish', $event));
    }
}
