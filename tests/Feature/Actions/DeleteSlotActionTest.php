<?php

namespace Tests\Feature\Actions;

use App\Domain\Slot\Actions\DeleteSlotAction;
use App\Domain\Slot\Models\Slot;
use Tests\TestCase;

class DeleteSlotActionTest extends TestCase
{
    /** @test */
    public function it_can_delete_a_slot()
    {
        $slot = factory(Slot::class)->create();

        (new DeleteSlotAction())->execute($slot);

        $this->assertCount(0, Slot::get());
    }
}
