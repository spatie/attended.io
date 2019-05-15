<?php

namespace Tests\Unit\Rules;

use App\Domain\Shared\Rules\CountryCodeRule;
use Tests\TestCase;

class CountryCodeTest extends TestCase
{
    /** @test */
    public function it_will_return_true_for_a_valid_iso_3166_country_code()
    {
        $rule = new CountryCodeRule();

        $this->assertTrue($rule->passes('attribute', 'BE'));
        $this->assertTrue($rule->passes('attribute', null));
        $this->assertFalse($rule->passes('attribute', 'LMAO'));
    }
}
