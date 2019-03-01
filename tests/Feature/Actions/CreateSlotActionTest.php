<?php

namespace Tests\Feature\Actions;

use App\Domain\Event\Models\Event;
use App\Domain\Event\Models\Track;
use App\Domain\Slot\Actions\CreateSlotAction;
use App\Domain\Slot\Enums\SlotType;
use App\Domain\Slot\Models\Speaker;
use Tests\TestCase;

class CreateSlotActionTest extends TestCase
{
    /** @var \App\Domain\Slot\Models\Slot */
    protected $slot;

    public function setUp(): void
    {
        parent::setUp();

        $this->setNow(2019, 1, 1);
    }

    /** @test */
    public function it_can_create_a_slot()
    {
        $event = factory(Event::class)->create();

        $creationAttributes = $this->slotAttributes($event);

        $updatedSlot = (new CreateSlotAction())->execute($event, $creationAttributes);

        $this->assertEquals($creationAttributes['name'], $updatedSlot->name);
        $this->assertEquals($creationAttributes['event_id'], $updatedSlot->event_id);

        $this->assertEquals($creationAttributes['track_id'], $updatedSlot->track_id);
        $this->assertEquals($creationAttributes['starts_at']->timestamp, $updatedSlot->starts_at->timestamp);
        $this->assertEquals($creationAttributes['ends_at']->timestamp, $updatedSlot->ends_at->timestamp);
        $this->assertEquals($creationAttributes['description'], $updatedSlot->description);
        $this->assertEquals($creationAttributes['type'], $updatedSlot->type);

        $this->assertCount(2, $updatedSlot->speakers);
        $this->assertEquals(
            $creationAttributes['speakers'],
            $updatedSlot
                ->speakers
                ->map(function (Speaker $speaker) {
                    return ['name' => $speaker->name, 'email' => $speaker->email];
                })
                ->toArray()
        );
    }

    protected function slotAttributes(Event $event, array $attributes = []): array
    {
        $defaultAttributes = [
            'name' => 'slot name',
            'event_id' => $event->id,
            'track_id' => factory(Track::class)->create([
                'event_id' => $event->id,
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
