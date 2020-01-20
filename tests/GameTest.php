<?php

namespace Test;

use Game\Character\Beast;
use Game\Character\Character;
use Game\Character\Hero;
use Game\Game;
use Game\Role\RoleSetter;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase {
    private $hero;
    private $beast;
    private $setter;

    protected function setUp(): void
    {
        $this->hero = new Hero;
        $this->beast = new Beast;
        $this->setter = new RoleSetter;
    }

    public function testPlayReturnWinner()
    {
        $this->hero->setStats('speed', 1);
        $this->beast->setStats('speed', 0);
        $this->beast->setStats('health', 0);

        $game = new Game($this->hero, $this->beast, $this->setter);

        $this->assertEquals($this->hero, $game->play());
    }

    public function testPlayMaxTurns()
    {
        $this->hero->setStats('health', 1000);
        $this->beast->setStats('health', 1000);

        $game = new Game($this->hero, $this->beast, $this->setter);
        $game->setTurns(Game::MAX_TURNS - 1);

        $this->assertNull($game->play());
    }

    public function testPlaySimulateFight()
    {
        $this->hero->setStats('health', 100);
        $this->hero->setStats('strength', 50);
        $this->hero->setStats('defence', 0);
        $this->hero->setStats('speed', 10);
        $this->hero->setStats('luck', 100);

        $this->beast->setStats('health', 100);
        $this->beast->setStats('strength', 100);
        $this->beast->setStats('defence', 0);
        $this->beast->setStats('speed', 20);
        $this->beast->setStats('luck', 0);

        $game = new Game($this->hero, $this->beast, $this->setter);

        $this->assertEquals($this->hero, $game->play());
    }
}
