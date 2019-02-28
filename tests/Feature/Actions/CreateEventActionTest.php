<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\CreateEventAction;
use App\Domain\Event\Notifications\EventCreatedNotification;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CreateEventActionTest extends TestCase
{
    /** @var \Illuminate\Support\Collection */
    protected $admins;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        $this->admins = factory(User::class, 3)->state('admin')->create();
    }

    /** @test */
    public function it_can_create_an_event()
    {
        $eventAttributes = $this->eventAttributes();

        $organizingUser = factory(User::class)->create();

        $event = (new CreateEventAction())->execute($organizingUser, $eventAttributes);

        foreach ([
                     'name',
                     'description',
                     'location',
                     'city',
                     'country_code',
                     'website',
                     'cfp',
                     'cfp_link',
                 ] as $attributeName) {
            $this->assertEquals($eventAttributes[$attributeName], $event->$attributeName);
        }

        $this->assertEquals('Belgium', $event->country_name);
        $this->assertEquals('🇧🇪', $event->country_emoji);

        foreach (['starts_at', 'ends_at', 'cfp_deadline'] as $attributeName) {
            $this->assertEquals($eventAttributes[$attributeName]->format('Y-m-d H:i:s'), $event->$attributeName->format('Y-m-d H:i:s'));
        }

        $this->assertEquals(
            [$organizingUser->id],
            $event->organizingUsers->pluck('id')->toArray()
        );

        $this->admins->each(function (User $admin) {
            Notification::assertSentTo($admin, EventCreatedNotification::class);
        });

        $this->assertFalse($event->isApproved());
    }

    /** @test */
    public function it_will_automatically_approve_events_from_certain_users()
    {
        $eventAttributes = $this->eventAttributes();

        $organizingUser = factory(User::class)->create([
            'can_publish_events_immediately' => true,
        ]);

        $event = (new CreateEventAction())->execute($organizingUser, $eventAttributes);

        $this->assertTrue($event->isApproved());

        Notification::assertTimesSent(0, EventCreatedNotification::class);
    }

    /**
     * @return array
     */
    protected function eventAttributes(array $attributes = []): array
    {
        $defaultAttributes = [
            'name' => faker()->name,
            'description' => faker()->sentence,
            'location' => faker()->word,
            'starts_at' => now(),
            'ends_at' => now()->addDay(),
            'city' => faker()->city,
            'country_code' => 'be',
            'website' => faker()->url,
            'cfp' => true,
            'cfp_link' => faker()->url,
            'cfp_deadline' => now(),
        ];

        return array_merge($defaultAttributes, $attributes);
    }
}
