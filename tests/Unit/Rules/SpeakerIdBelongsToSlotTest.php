<?php

namespace Tests\Unit\Rules;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\Slot\Rules\SpeakerIdBelongsToSlot;
use Tests\TestCase;

class SpeakerIdBelongsToSlotTest extends TestCase
{
    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function setUp(): void
    {
        parent::setUp();

        $this->slot = factory(Slot::class)->create();
    }

    /** @test */
    public function it_can_determine_if_a_speaker_id_belongs_to_an_slot()
    {
        $speakerId = factory(Speaker::class)->create([
           'slot_id' => $this->slot->id,
        ])->id;
        $this->assertTrue($this->rulePasses($speakerId));

        $speakerIdFromOtherSlot = factory(Speaker::class)->create()->id;
        $this->assertFalse($this->rulePasses($speakerIdFromOtherSlot));

        $this->assertTrue($this->rulePasses(''));
    }

    public function rulePasses($speakerId): bool
    {
        return (new SpeakerIdBelongsToSlot($this->slot))->passes('speakerId', $speakerId);
    }
}
