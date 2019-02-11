<?php

namespace Tests\Unit\Rules;

use App\Models\User;
use App\Rules\CurrentPasswordRule;
use Tests\TestCase;

class CurrentPasswordRuleTest extends TestCase
{
    /** @test */
    public function it_can_verify_it_the_value_is_the_password_of_the_currently_logged_in_user()
    {
        $this->assertFalse($this->rulePasses('secret'));

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->assertTrue($this->rulePasses('secret'));

        $this->assertFalse($this->rulePasses('wrong-password'));
    }

    public function rulePasses(string $password): bool
    {
        return (new CurrentPasswordRule())->passes('password', $password);
    }
}
