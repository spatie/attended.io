<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\PublishEventAction;
use App\Domain\Event\Models\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PublishEventActionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function it_can_publish_an_event()
    {
        $event = factory(Event::class)->create([
            'published_at' => null,
        ]);

        $this->assertFalse($event->isPublished());

        (new PublishEventAction())->execute($event);

        $this->assertTrue($event->isPublished());
    }
}
