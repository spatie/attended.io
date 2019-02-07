<?php

namespace Tests\Unit\Models\Concerns;

use App\Models\Slot;
use Tests\TestCase;

class HasShortSlugTest extends TestCase
{
    /** @test */
    public function it_can_generate_a_short_slug()
    {
        $slot = factory(Slot::class)->create();

        $this->assertNotNull($slot->short_slug);
    }

    public function it_can_find_a_model_by_its_short_slug()
    {
        $slot = factory(Slot::class)->create();

        $foundSlot = Slot::findByShortSlug($slot->short_slug);

        $this->assertEquals($slot->id, $foundSlot->id);

        $this->assertNull(Slot::findByShortSlug('non-existing-short-slug'));
    }

    /** @test */
    public function it_will_redirect_to_the_full_url()
    {
        $slot = factory(Slot::class)->create();

        $expectedRedirect = route('slots.show', $slot->idSlug());

        $this->get($slot->short_slug)->assertRedirect($expectedRedirect);
        $this->get(strtoupper($slot->short_slug))->assertRedirect($expectedRedirect);
        $this->get('non-existing-short-slug')->assertNotFound();
    }
}
