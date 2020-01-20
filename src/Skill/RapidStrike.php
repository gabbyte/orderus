<?php
declare(strict_types=1);

namespace Game\Skill;

class RapidStrike extends AbstractSkill {
    protected $chance = 10;

    public function use(array $data) :int
    {
        return $data['attacker']->getStrikeDamage($data['defence']);
    }
}