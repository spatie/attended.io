<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Actions\CreateEventAction;
use App\Domain\User\Models\User;
use Tests\TestCase;

class CreateEventActionTest extends TestCase
{
    /** @test */
    public function it_can_create_an_event()
    {
        $eventAttributes = [
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
    }
}
