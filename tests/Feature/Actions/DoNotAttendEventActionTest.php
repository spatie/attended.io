<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\AttendEventAction;
use App\Domain\Event\Actions\DoNotAttendEventAction;
use App\Models\Event;
use App\Domain\User\Models\User;
use Tests\TestCase;

class DoNotAttendEventActionTest extends TestCase
{
    /** @test */
    public function it_can_remove_a_user_from_the_attendees_of_an_event()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create();

        (new AttendEventAction())->execute($user, $event);

        $this->assertTrue($user->attended($event));

        (new DoNotAttendEventAction())->execute($user, $event);

        $this->assertFalse($user->attended($event));
    }
}
