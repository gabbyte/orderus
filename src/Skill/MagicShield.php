<?php
declare(strict_types=1);

namespace Game\Skill;

class MagicShield extends AbstractSkill {
    protected $chance = 20;

    public function use(array $data) :int
    {
        return intval($data['damage'] / 2);
    }
}