<?php

namespace Tests\Character;

use Game\Character\Beast;

class BeastTest extends AbstractCharacterTest {

    protected function initialize()
    {
        $this->character = new Beast;
        $this->stats = [
            'health'   => ['min' => 60, 'max' => 90],
            'strength' => ['min' => 60, 'max' => 90],
            'defence'  => ['min' => 40, 'max' => 60],
            'speed'    => ['min' => 40, 'max' => 60],
            'luck'     => ['min' => 25, 'max' => 40],
        ];
    }
}
