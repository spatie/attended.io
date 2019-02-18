<?php

namespace Tests\Feature\Actions;

use App\Domain\User\Actions\UpdatePasswordAction;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdatePasswordActionTest extends TestCase
{
    /** @test */
    public function it_can_change_the_password_of_the_given_user()
    {
        $newPassword = 'new-password';

        $user = factory(User::class)->create();

        (new UpdatePasswordAction())->execute($user, $newPassword);

        $this->assertFalse(Hash::check('secret', $user->password));
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}
