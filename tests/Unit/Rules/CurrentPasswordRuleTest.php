<?php

namespace Tests\Unit\Rules;

use App\Models\User;
use App\Rules\CurrentPasswordRule;
use Tests\TestCase;

class CurrentPasswordRuleTest extends TestCase
{
    /** @test */
    public function it_can_verify_that_the_given_value_is_the_password_of_the_user()
    {
        $user = factory(User::class)->create();

        $this->assertTrue($this->rulePasses($user, 'secret'));

        $this->assertFalse($this->rulePasses($user, 'wrong-password'));
    }

    public function rulePasses(User $user, string $password): bool
    {
        return (new CurrentPasswordRule($user))->passes('password', $password);
    }
}
