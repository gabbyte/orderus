<?php
declare(strict_types=1);

namespace Game\Character;

use Game\Chance\Chance;
use Game\Skill\AbstractSkill;

class Character {
    protected $name;
    protected $stats;
    /** @var AbstractSkill[] $skills */
    protected $skills = [];
    protected $last_damage_absorbed;

    public function getName() :string
    {
        return $this->name;
    }

    public function getStats(string $name = '')
    {
        return $name ? $this->stats[$name] : $this->stats;
    }

    public function setStats(string $stats, $value)
    {
        $this->stats[$stats] = $value;

        return $this;
    }

    public function getStrikeDamage(int $defence)
    {
        $damage = $this->getStats('strength') - $defence;

        return $damage > 0 ? $damage : 0;
    }

    public function getHealthAfterDefend(int $damage) :int
    {
        $damage = Chance::roll($this->getStats('luck')) ? 0 : $damage;
        $this->setLastDamageAbsorbed($damage);
        $health = $this->getStats('health') - $damage;

        return $health > 0 ? $health : 0;
    }

    public function canUseSkill(string $name)
    {
        return (isset($this->skills[$name]) && $this->skills[$name]->canUse());
    }

    public function setSkill(string $name, AbstractSkill $skill)
    {
        $this->skills[$name] = $skill;

        return $this;
    }

    public function setLastDamageAbsorbed(int $damage)
    {
        $this->last_damage_absorbed = $damage;

        return $this;
    }

    public function getLastDamageAbsorbed() :int
    {
        return $this->last_damage_absorbed;
    }
}