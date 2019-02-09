<?php

namespace Tests\Unit\Policies;

use App\Models\Event;
use App\Models\User;
use App\Policies\EventPolicy;
use Tests\TestCase;

class EventPolicyTest extends TestCase
{
    /** @var \App\Models\Event */
    protected $event;

    /** @var \App\Models\User */
    protected $user;

    /** @var \App\Policies\EventPolicy */
    protected $policy;

    public function setUp()
    {
        parent::setUp();

        $this->event = factory(Event::class)->create();

        $this->user = factory(User::class)->create();

        $this->policy = new EventPolicy();
    }

    /** @test */
    public function an_owner_of_event_is_allowed_to_administer_it()
    {
        $this->assertFalse($this->policyAllows('administer'));

        $this->event->owners()->attach($this->user);

        $this->assertTrue($this->policyAllows('administer'));
    }

    /** @test */
    public function an_owner_a_another_event_cannot_administer_this_event()
    {
        $anotherEvent = factory(Event::class)->create();

        $anotherEvent->owners()->attach($this->user);

        $this->assertFalse($this->policyAllows('administer'));
    }

    protected function policyAllows(string $ability)
    {
        return $this->policy->$ability($this->user->refresh(), $this->event->refresh());
    }
}