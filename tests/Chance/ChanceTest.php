<?php

use Game\Chance\Chance;
use PHPUnit\Framework\TestCase;

class ChanceTest extends TestCase {

    public function testRollIsTrue()
    {
        $this->assertTrue(Chance::roll(10, 9));
    }

    public function testRollIsFalse()
    {
        $this->assertFalse(Chance::roll(10, 11));
    }
}
