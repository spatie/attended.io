<?php

namespace Tests\Unit\Models\Presenters;

use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\User\Models\User;
use Tests\TestCase;

class PresentsSlotTest extends TestCase
{
    /** @test */
    public function it_can_present_the_speakers_as_a_string()
    {
        $slot = factory(Slot::class)->create();

        $this->assertEquals('', $slot->speakersAsString());

        factory(Speaker::class)->create([
            'slot_id' => $slot->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'user_id' => null,
        ]);
        $this->assertEquals('John Doe', $slot->refresh()->speakersAsString());

        $anotherUser = factory(User::class)->create(['name' => 'username Jane']);
        factory(Speaker::class)->create([
            'slot_id' => $slot->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'user_id' => $anotherUser->id,
        ]);
        $this->assertEquals('John Doe and <a href="http://attended.io/users/' . $anotherUser->id .'">username Jane</a>', $slot->refresh()->speakersAsString());

        factory(Speaker::class)->create([
            'slot_id' => $slot->id,
            'name' => 'Janis Doe',
            'email' => 'jane@example.com',
            'user_id' => null,
        ]);
        $this->assertEquals('John Doe, <a href="http://attended.io/users/' . $anotherUser->id .'">username Jane</a> and Janis Doe', $slot->refresh()->speakersAsString());

    }
}