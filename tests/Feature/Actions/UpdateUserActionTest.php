<?php

namespace Tests\Feature\Actions;

use App\Actions\UpdateUserAction;
use App\Models\User;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
{
    /** @test */
    public function it_can_update_a_user()
    {
        $user = factory(User::class)->create();

        (new UpdateUserAction())->execute($user, [
            'name' => 'updated-name',
            'email' => 'new-user@example.com',
        ]);

        $this->assertEquals('updated-name', $user->name);
        $this->assertEquals('new-user@example.com', $user->email);
    }
}
