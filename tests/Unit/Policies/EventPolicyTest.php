<?php

namespace Tests\Unit\Policies;

use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Tests\TestCase;

class EventPolicyTest extends TestCase
{
    /** @var \App\Domain\Event\Models\Event */
    protected $event;

    /** @var \App\Domain\User\Models\User */
    protected $user;

    public function setUp()
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

        $this->event->owners()->attach($this->user);
        $this->event->refresh();
        $this->user->refresh();

        $this->assertTrue($this->user->can('administer', $this->event));
    }

    /** @test */
    public function an_owner_a_another_event_cannot_administer_this_event()
    {
        $anotherEvent = factory(Event::class)->create();

        $anotherEvent->owners()->attach($this->user);
        $this->event->refresh();

        $this->assertFalse($this->user->can('administer', $this->event));
    }
}
