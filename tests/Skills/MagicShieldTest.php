<?php


use Game\Skill\MagicShield;
use PHPUnit\Framework\TestCase;

class MagicShieldTest extends TestCase {

    public function testDamageIsHalved()
    {
        $skill = new MagicShield;

        $this->assertEquals(49, $skill->use(['damage' => 99]));
    }
}