<?php

namespace Test\Role;

use Game\Character\Beast;
use Game\Character\Hero;
use Game\Role\RoleSetter;
use PHPUnit\Framework\TestCase;

class RoleSetterTest extends TestCase {
    private static $setter;
    private static $hero;
    private static $beast;
    
    public static function setUpBeforeClass(): void
    {
        self::$setter = new RoleSetter;
        self::$hero = new Hero;
        self::$beast = new Beast;
    }

    public function testSetSameSpeedBiggerLuckFirstChar()
    {
        self::$hero->setStats('speed', 1)->setStats('luck', 1);
        self::$beast->setStats('speed', 1)->setStats('luck', 0);

        self::$setter->set(self::$hero, self::$beast);

        $this->assertEquals(self::$hero, self::$setter->getAttacker());
        $this->assertEquals(self::$beast, self::$setter->getDefender());
    }

    public function testSetSameSpeedBiggerLuckSecondChar()
    {
        self::$hero->setStats('speed', 1)->setStats('luck', 0);
        self::$beast->setStats('speed', 1)->setStats('luck', 1);

        self::$setter->set(self::$hero, self::$beast);

        $this->assertEquals(self::$beast, self::$setter->getAttacker());
        $this->assertEquals(self::$hero, self::$setter->getDefender());
    }

    public function testSetSameSpeedAndLuck()
    {
        self::$hero->setStats('speed', 1)->setStats('luck', 1);
        self::$beast->setStats('speed', 1)->setStats('luck', 1);

        self::$setter->setRandom(0);
        self::$setter->set(self::$hero, self::$beast);

        $this->assertEquals(self::$hero, self::$setter->getAttacker());
        $this->assertEquals(self::$beast, self::$setter->getDefender());
    }

    public function testSetBiggerSpeedFirstChar()
    {
        $this->_prepareBiggerSpeedFirstChar();

        $this->assertEquals(self::$hero, self::$setter->getAttacker());
        $this->assertEquals(self::$beast, self::$setter->getDefender());
    }

    public function testSetBiggerSpeedSecondChar()
    {
        self::$hero->setStats('speed', 1)->setStats('luck', 1);
        self::$beast->setStats('speed', 2)->setStats('luck', 0);

        self::$setter->set(self::$hero, self::$beast);

        $this->assertEquals(self::$beast, self::$setter->getAttacker());
        $this->assertEquals(self::$hero, self::$setter->getDefender());
    }

    public function testSwap()
    {
        $this->_prepareBiggerSpeedFirstChar();

        self::$setter->swap();

        $this->assertEquals(self::$beast, self::$setter->getAttacker());
        $this->assertEquals(self::$hero, self::$setter->getDefender());
    }

    private function _prepareBiggerSpeedFirstChar()
    {
        self::$hero->setStats('speed', 2)->setStats('luck', 1);
        self::$beast->setStats('speed', 1)->setStats('luck', 0);

        self::$setter->set(self::$hero, self::$beast);
    }
}
