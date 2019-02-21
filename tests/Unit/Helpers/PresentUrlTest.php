<?php

namespace Tests\Unit\Helpers;

use Tests\TestCase;

class PresentUrlTest extends TestCase
{
    /** @test */
    public function it_can_present_a_url()
    {
        $this->assertEquals('example.com', present_url('https://example.com'));
        $this->assertEquals('example.com', present_url('http://example.com'));
        $this->assertEquals('example.com', present_url('example.com'));
        $this->assertEquals('', present_url(''));
    }
}
