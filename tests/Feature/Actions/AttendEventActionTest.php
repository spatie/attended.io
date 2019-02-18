<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\AttendEventAction;
use App\Domain\Event\Models\Event;
use App\Domain\User\Models\User;
use Tests\TestCase;

class AttendEventActionTest extends TestCase
{
    /** @test */
    public function it_can_add_a_user_from_the_attendees_of_an_event()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();

        $this->assertFalse($user->attended($event));

        (new AttendEventAction())->execute($user, $event);

        $this->assertTrue($user->attended($event));
    }
}
