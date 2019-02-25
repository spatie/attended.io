<?php

namespace Tests\Unit\Models;

use App\Domain\Event\Models\Attendance;
use App\Domain\Event\Models\Event;
use App\Domain\Slot\Models\Slot;
use App\Domain\User\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @var \App\Domain\User\Models\User */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_can_determine_if_a_user_speaks_at_events()
    {
        $this->assertFalse($this->user->speaksAtEvents());

        $slot = factory(Slot::class)->create();

        $slot->speakers()->attach($this->user);

        $this->assertTrue($this->user->speaksAtEvents());
    }

    /** @test */
    public function it_can_determine_if_a_user_organises_events()
    {
        $this->assertFalse($this->user->organisesEvents());

        $event = factory(Event::class)->create();

        $event->organizingUsers()->attach($this->user);

        $this->assertTrue($this->user->organisesEvents());
    }

    /** @test */
    public function it_can_determine_if_a_user_attends_events()
    {
        $this->assertFalse($this->user->attendsEvents());

        $event = factory(Event::class)->create();

        Attendance::create([
            'event_id' => $event->id,
            'user_id' => $this->user->id,
        ]);

        $this->assertTrue($this->user->attendsEvents());
    }

    /** @test */
    public function it_can_determine_if_a_user_has_reviewed_a_reviewable()
    {
        $event = factory(Event::class)->create();

        $user = factory(User::class)->create();

        $this->assertFalse($user->hasReviewed($event));

        $event->reviews()->create([
            'user_id' => $user->id,
            'rating' => $reviewAttributes['rating'] ?? null,
            'remarks' => $reviewAttributes['remarks'] ?? null,
        ]);

        $this->assertTrue($user->hasReviewed($event));
    }

    /** @test */
    public function it_can_generate_the_link_to_joined_in()
    {
        $user = factory(User::class)->create(['joindin_username' => null]);

        $this->assertEquals('', $user->joindInProfileUrl());

        $user->joindin_username = 'johndoe';
        $user->save();

        $this->assertEquals('https://joind.in/user/johndoe', $user->joindInProfileUrl());
    }

    /** @test */
    public function it_can_generate_a_gravatar_url()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'name' => 'John Doe',
        ]);

        $this->assertEquals(
            'https://gravatar.com/avatar/fd876f8cd6a58277fc664d47ea10ad19?d=https%3A%2F%2Fui-avatars.com%2Fapi%2FJohn+Doe%2F512%2Ff2f3f8%2F2c2e3e',
            $user->gravatarUrl()
        );
    }

    /** @test */
    public function it_has_a_scope_to_get_all_admins()
    {
        factory(User::class, 5)->create();

        $admins = factory(User::class, 5)->state('admin')->create();

        $retrievedAdmins = User::admin()->get();

        $this->assertEquals(count($admins), count($retrievedAdmins));

        $this->assertEquals(
            $admins->pluck('id')->toArray(),
            $retrievedAdmins->pluck('id')->toArray(),
            );
    }
}
