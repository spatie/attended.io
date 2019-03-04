<?php

namespace Tests\Unit\Models;

use App\Domain\Slot\Models\Speaker;
use App\Domain\User\Models\User;
use Tests\TestCase;

class SpeakerTest extends TestCase
{
    /** @test */
    public function it_can_get_the_name_and_email_for_a_speaker()
    {
        $speaker = factory(Speaker::class)->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'user_id' => null,
        ]);

        $this->assertEquals('John Doe', $speaker->name());
        $this->assertEquals('john@example.com', $speaker->email());

        $user = factory(User::class)->create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
        $speaker->update(['user_id' => $user->id]);

        $speaker->refresh();
        $this->assertEquals('Jane Doe', $speaker->name());
        $this->assertEquals('jane@example.com', $speaker->email());
    }

    public function it_can_determine_if_the_invitation_has_already_been_sent()
    {
        /** @var Speaker $speaker */
        $speaker = factory(Speaker::class)->create();

        $this->assertFalse($speaker->hasBeenSentInvitation());

        $speaker->markAsInvitationSent();

        $this->assertTrue($speaker->hasBeenSentInvitation());
    }

    /** @test */
    public function it_can_determine_if_it_has_a_user_account()
    {
        /** @var Speaker $speaker */
        $speaker = factory(Speaker::class)->create(['user_id' => null]);
        $this->assertFalse($speaker->hasUserAccount());

        $speaker->update(['user_id' => factory(User::class)->create()->id]);
        $this->assertTrue($speaker->refresh()->hasUserAccount());
    }
}
