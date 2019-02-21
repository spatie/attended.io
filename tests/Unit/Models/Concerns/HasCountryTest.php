<?php

namespace Tests\Unit\Models\Concerns;

use App\Domain\Event\Models\Event;
use Tests\TestCase;

class HasCountryTest extends TestCase
{
    /** @test */
    public function it_will_update_the_country_name_and_emoji()
    {
        $event = factory(Event::class)->create();

        $event->country_code = 'be';
        $event->save();
        $this->assertEquals('Belgium', $event->country_name);
        $this->assertEquals('🇧🇪', $event->country_emoji);

        $event->country_code = null;
        $event->save();
        $this->assertNull($event->country_name);
        $this->assertNull($event->country_emoji);
    }
}
