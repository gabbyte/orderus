<?php
declare(strict_types=1);

namespace Game\Character;

class Beast extends Character {
    protected $name = 'Beast';

    public function __construct()
    {
        $this->stats = [
            'health'   => rand(60, 90),
            'strength' => rand(60, 90),
            'defence'  => rand(40, 60),
            'speed'    => rand(40, 60),
            'luck'     => rand(25, 40)
        ];
    }
}