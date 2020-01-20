<?php

namespace Game\Role;

use Game\Character\Character;

class RoleSetter {
    private $random;
    private $attacker;
    private $defender;

    public function set(Character $first, Character $second)
    {
        if ($first->getStats('speed') == $second->getStats('speed')) {
            return $this->setRolesForEqualSpeedCharacters($first, $second);
        }

        if ($first->getStats('speed') > $second->getStats('speed')) {
            $this->attacker = $first;
            $this->defender = $second;
        } else {
            $this->attacker = $second;
            $this->defender = $first;
        }

        return $this;
    }

    public function swap()
    {
        $tmp = $this->getAttacker();
        $this->attacker = $this->getDefender();
        $this->defender = $tmp;

        return $this;
    }

    public function getAttacker() :Character
    {
        return $this->attacker;
    }

    public function getDefender() :Character
    {
        return $this->defender;
    }

    public function setRandom(int $random)
    {
        $this->random = $random;
    }

    public function getRandom() :int
    {
        return $this->random ?? rand(0, 1);
    }

    private function setRolesForEqualSpeedCharacters(Character $first, Character $second)
    {
        if ($first->getStats('luck') > $second->getStats('luck')) {
            $this->attacker = $first;
            $this->defender = $second;
        } elseif ($first->getStats('luck') < $second->getStats('luck')) {
            $this->attacker = $second;
            $this->defender = $first;
        } else {
            $random = $this->getRandom();
            $this->attacker = ($random == 0) ? $first : $second;
            $this->defender = ($random == 1) ? $first: $second;
        }

        return $this;
    }
}