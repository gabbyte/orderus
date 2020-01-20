<?php

namespace Tests\Character;

use Game\Character\Character;
use PHPUnit\Framework\TestCase;

abstract class AbstractCharacterTest extends TestCase {
    /** @var Character $character */
    protected $character;
    protected $stats = [];
    protected $stats_names = ['health', 'strength', 'defence', 'speed', 'luck'];

    abstract protected function initialize();

    protected function setUp(): void
    {
        $this->initialize();
    }

    public function testsStatsWithinLimits()
    {
        foreach ($this->stats_names as $name) {
            $this->assertTrue($this->character->getStats($name) >= $this->stats[$name]['min'], "{$name} is at least equal to the minimum value");
            $this->assertTrue($this->character->getStats($name) <= $this->stats[$name]['max'], "{$name} is at most equal to the maximum value");
        }
    }
}