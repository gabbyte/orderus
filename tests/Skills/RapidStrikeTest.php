<?php

use Game\Skill\RapidStrike;
use PHPUnit\Framework\TestCase;

class RapidStrikeTest extends TestCase {
    static $skill;

    public static function setUpBeforeClass(): void
    {
        self::$skill = new RapidStrike;
    }

    public function testSkillCallsTargetMethod()
    {
        $target = 10;
        $stub = $this->createMock(\Game\Character\Character::class);
        $stub->method('getStrikeDamage')->will($this->returnArgument(0));

        $this->assertEquals(self::$skill->use(['attacker' => $stub, 'defence' => $target]), $target);
    }
}
