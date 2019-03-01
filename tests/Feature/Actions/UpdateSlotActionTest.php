<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Models\Track;
use App\Domain\Slot\Actions\UpdateSlotAction;
use App\Domain\Slot\Enums\SlotType;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use Tests\TestCase;

class UpdateSlotActionTest extends TestCase
{
    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function setUp(): void
    {
        parent::setUp();

        $this->slot = factory(Slot::class)->create();

        $this->setNow(2019, 1, 1);
    }

    /** @test */
    public function it_can_update_a_slot()
    {
        $updateAttributes = $this->slotAttributes();

        $updatedSlot = (new UpdateSlotAction())->execute($this->slot, $updateAttributes);

        $this->assertEquals($updateAttributes['name'], $updatedSlot->name);
        $this->assertEquals($updateAttributes['track_id'], $updatedSlot->track_id);
        $this->assertEquals($updateAttributes['starts_at']->timestamp, $updatedSlot->starts_at->timestamp);
        $this->assertEquals($updateAttributes['ends_at']->timestamp, $updatedSlot->ends_at->timestamp);
        $this->assertEquals($updateAttributes['description'], $updatedSlot->description);
        $this->assertEquals($updateAttributes['type'], $updatedSlot->type);

        $this->assertCount(2, $updatedSlot->speakers);
        $this->assertEquals(
            $updateAttributes['speakers'],
            $updatedSlot
                ->speakers
                ->map(function (Speaker $speaker) {
                    return ['name' => $speaker->name, 'email' => $speaker->email];
                })
                ->toArray()
        );
    }

    /** @test */
    public function it_will_not_update_the_event_id()
    {
        $originalEventId = $this->slot->event->id;
        $updateAttributes = $this->slotAttributes(['event_id' => 1234]);

        $updatedSlot = (new UpdateSlotAction())->execute($this->slot, $updateAttributes);

        $this->assertEquals($originalEventId, $updatedSlot->event->id);
    }

    protected function slotAttributes($attributes = []): array
    {
        $defaultAttributes = [
            'name' => 'updated name',
            'track_id' => factory(Track::class)->create([
                'event_id' => $this->slot->event->id,
            ])->id,
            'starts_at' => now()->addDays(3)->startOfDay(),
            'ends_at' => now()->addDays(5)->endOfDay(),
            'description' => 'updated description',
            'type' => SlotType::TALK,
            'speakers' => [
                ['name' => 'John Doe', 'email' => 'john@example.com'],
                ['name' => 'Jane Doe', 'email' => 'jane@example.com']
            ],
        ];

        return array_merge($defaultAttributes, $attributes);
    }
}
