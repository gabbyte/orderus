<?php
declare(strict_types=1);

namespace Game\Character;

use Game\Log\Logger;

class Hero extends Character {
    protected $name = 'Orderus';

    public function __construct()
    {
        $this->stats = [
            'health'   => rand(70, 100),
            'strength' => rand(70, 80),
            'defence'  => rand(45, 55),
            'speed'    => rand(40, 50),
            'luck'     => rand(10, 30)
        ];
    }

    public function getStrikeDamage(int $defence) :int
    {
        $damage = parent::getStrikeDamage($defence);
        if ($this->canUseSkill('rapid_strike')) {
            $damage += $this->skills['rapid_strike']->use(['attacker' => $this, 'defence' => $defence]);

            Logger::instance()->log("{$this->name} used Rapid Strike");
        }

        return $damage;
    }

    public function getHealthAfterDefend(int $damage) :int
    {
        if ($this->canUseSkill('magic_shield')) {
            $damage = $this->skills['magic_shield']->use(['damage' => $damage]);

            Logger::instance()->log("{$this->name} used the Magic Shield");
        }

        return parent::getHealthAfterDefend($damage);
    }
}