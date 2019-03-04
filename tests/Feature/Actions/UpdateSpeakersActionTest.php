<?php

namespace Tests\Feature\Actions;

use App\Domain\Slot\Actions\UpdateSpeakersAction;
use App\Domain\Slot\Models\Slot;
use App\Domain\Slot\Models\Speaker;
use App\Domain\User\Models\User;
use Tests\TestCase;

class UpdateSpeakersActionTest extends TestCase
{
    /** @test */
    public function it_can_update_the_speakers_of_a_slot()
    {
        $slot = factory(Slot::class)->create();

        [$firstSpeaker, $secondSpeaker, $thirdSpeaker] = factory(Speaker::class, 3)
            ->create([
                'slot_id' => $slot->id,
                'user_id' => null,
            ])
            ->values();

        $firstSpeakerOrignalAttributes = $firstSpeaker->getAttributes();

        (new UpdateSpeakersAction())->execute($slot, [
            ['id' => $firstSpeaker->id, 'name' => $firstSpeaker->name, 'email' => $firstSpeaker->email],
            ['id' => $secondSpeaker->id, 'name' => 'updated name', 'email' => 'updated@example.com'],
            ['id' => null, 'name' => 'new speaker', 'email' => 'new@example.com'],
        ]);

        $this->assertEquals($firstSpeakerOrignalAttributes['name'], $firstSpeaker->refresh()->name);
        $this->assertEquals($firstSpeakerOrignalAttributes['email'], $firstSpeaker->refresh()->email);

        $this->assertEquals('updated name', $secondSpeaker->refresh()->name);
        $this->assertEquals('updated@example.com', $secondSpeaker->refresh()->email);

        $this->assertNull(Speaker::where('id', $thirdSpeaker->id)->first());

        $slot->refresh();
        $this->assertCount(3, $slot->speakers);
        $this->assertEquals($firstSpeaker->id, $slot->speakers[0]->id);
        $this->assertEquals($secondSpeaker->id, $slot->speakers[1]->id);

        $this->assertEquals('new speaker', $slot->speakers[2]->name);
        $this->assertEquals('new@example.com', $slot->speakers[2]->email);
    }

    /** @test */
    public function it_will_not_add_a_speaker_that_has_the_same_email_address_of_a_user_of_an_existing_speaker()
    {
        $slot = factory(Slot::class)->create();

        $speaker = factory(Speaker::class)->create([
            'slot_id' => $slot->id,
            'email' => 'speaker@example.com',
            'user_id' => factory(User::class)->create(['email' => 'speaker-user@example.com'])->id,
        ]);

        (new UpdateSpeakersAction())->execute($slot, [
            ['id' => null, 'name' => 'speaking user already exist', 'email' => $speaker->user->email],
            ['id' => null, 'name' => 'new speaker', 'email' => 'new@example.com'],
        ]);

        $this->assertCount(2, $slot->refresh()->speakers);
        $this->assertEquals([
            $speaker->email,
            'new@example.com',
        ], $slot->refresh()->speakers->pluck('email')->toArray());
    }
}
