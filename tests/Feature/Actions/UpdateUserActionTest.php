<?php

namespace Tests\Feature\Actions;

use App\Domain\User\Actions\UpdateUserAction;
use App\Domain\User\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = factory(User::class)->create();

        (new UpdateUserAction())->execute($user, [
            'name' => 'updated-name',
            'email' => 'new-user@example.com',
            'bio' => 'my bio',
            'city' => 'Brussels',
            'country_code' => 'be',
            'joindin_username' => 'my-joindin-username'
        ]);

        $this->assertEquals('updated-name', $user->name);
        $this->assertEquals('new-user@example.com', $user->email);
        $this->assertEquals('my bio', $user->bio);
        $this->assertEquals('Brussels', $user->city);
        $this->assertEquals('be', $user->country_code);
        $this->assertEquals('my-joindin-username', $user->joindin_username);
    }

    /** @test */
    public function the_email_address_will_stay_verified_if_it_did_not_change()
    {
        $user = factory(User::class)->create();

        $this->assertTrue($user->hasVerifiedEmail());

        (new UpdateUserAction())->execute($user, [
            'name' => 'updated-name',
            'email' => $user->email,
        ]);

        $this->assertTrue($user->hasVerifiedEmail());

        Notification::assertNothingSent();
    }

    /** @test */
    public function the_email_address_will_need_to_verified_again_if_it_did_change()
    {
        $user = factory(User::class)->create();

        $this->assertTrue($user->hasVerifiedEmail());

        (new UpdateUserAction())->execute($user, [
            'name' => 'updated-name',
            'email' => 'updated-' . $user->email,
        ]);

        $this->assertFalse($user->hasVerifiedEmail());

        Notification::assertSentTo($user, VerifyEmail::class);
    }
}
