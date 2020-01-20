<?php

namespace Tests\Character;

use Game\Character\Hero;

class HeroTest extends AbstractCharacterTest {

    protected function initialize()
    {
        $this->character = new Hero();
        $this->stats = [
            'health'   => ['min' => 70, 'max' => 100],
            'strength' => ['min' => 70, 'max' => 80],
            'defence'  => ['min' => 45, 'max' => 55],
            'speed'    => ['min' => 40, 'max' => 50],
            'luck'     => ['min' => 10, 'max' => 30],
        ];
    }

    public function testStrikeWithSkillApplied()
    {
        $this->character->setStats('strength', 100);

        $this->assertEquals(50, $this->character->getStrikeDamage(50));
    }

    public function testDamageFormula()
    {
        $this->character->setStats('strength', 100);

        $this->assertEquals(50, $this->character->getStrikeDamage(50));
        $this->assertEquals(0, $this->character->getStrikeDamage(150));
    }

    public function testDefendFormula()
    {
        $this->character->setStats('health', 100);
        $this->character->setStats('luck', 0);

        $this->assertEquals(50, $this->character->getHealthAfterDefend(50));
        $this->assertEquals(0, $this->character->getHealthAfterDefend(150));
    }

    public function testMissedStrike()
    {
        $this->character->setStats('health', 1);
        $this->character->setStats('luck', 100);

        $this->assertEquals(1, $this->character->getHealthAfterDefend(50));
    }
}
