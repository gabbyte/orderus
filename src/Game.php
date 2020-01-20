<?php

namespace Game;

use Game\Character\Beast;
use Game\Character\Character;
use Game\Character\Hero;
use Game\Log\Logger;
use Game\Role\RoleSetter;
use Game\Skill\MagicShield;
use Game\Skill\RapidStrike;

class Game {
    const MAX_TURNS = 20;

    private $turns = 0;
    private $role_setter;
    private $logger;

    public function __construct(Hero $hero, Beast $beast, RoleSetter $role_setter)
    {
        $this->role_setter = $role_setter;
        $this->role_setter->set($this->prepareHero($hero), $beast);
        $this->logger = Logger::instance();

        $this->logger->logStats($hero->getStats(), 'hero');
        $this->logger->logStats($beast->getStats(), 'beast');
    }

    public function play() : ?Character
    {
        $this->incrementTurns();
        $this->strike();

        if ($this->getDefender()->getStats('health') == 0) {
            $this->logger->log("The winner is: {$this->getAttacker()->getName()}");

            return $this->getAttacker();
        }

        if ($this->turns == self::MAX_TURNS) {
            $this->logger->log("There is no winner after {$this->turns} turns");

            return null;
        }

        $this->role_setter->swap();

        return $this->play();
    }

    public function getDefender() :Character
    {
        return $this->role_setter->getDefender();
    }

    public function getAttacker() :Character
    {
        return $this->role_setter->getAttacker();
    }

    public function setTurns(int $turns)
    {
        $this->turns = $turns;

        return $this;
    }

    private function prepareHero(Hero $hero) :Hero
    {
        $hero->setSkill('rapid_strike', new RapidStrike);
        $hero->setSkill('magic_shield', new MagicShield);

        return $hero;
    }

    private function incrementTurns()
    {
        $this->turns++;
        $this->logger->log("Turn #{$this->turns}");
        $this->logger->log("{$this->getAttacker()->getName()} strikes...");

        return $this;
    }

    private function strike()
    {
        $defender_health = $this->getDefender()->getHealthAfterDefend(
            $this->getAttacker()->getStrikeDamage($this->getDefender()->getStats('defence'))
        );

        if ($defender_health == $this->getDefender()->getStats('health')) {
            $this->logger->log('Missed!');
        } else {
            $this->getDefender()->setStats('health', $defender_health);

            $this->logger->log("{$this->getAttacker()->getName()} inflected {$this->getDefender()->getLastDamageAbsorbed()} damage");
            $this->logger->log("{$this->getDefender()->getName()} has {$defender_health} health points left");
        }

        return $this;
    }
}