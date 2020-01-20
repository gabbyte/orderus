<?php
declare(strict_types=1);

namespace Game\Skill;

use Game\Chance\Chance;

abstract class AbstractSkill {
    protected $chance;

    abstract public function use(array $data) :int;

    public function setChance(int $chance)
    {
        $this->chance = $chance;

        return $this;
    }

    public function canUse() :bool
    {
        return Chance::roll($this->chance);
    }
}