<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\DeleteEventAction;
use App\Domain\Event\Models\Event;
use Tests\TestCase;

class DeleteEventActionTest extends TestCase
{
    /** @test */
    public function it_can_delete_an_event()
    {
        $event = factory(Event::class)->create();

        (new DeleteEventAction())->execute($event);

        $this->assertCount(0, Event::get());
    }
}
