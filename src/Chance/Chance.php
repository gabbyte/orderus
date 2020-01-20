<?php
declare(strict_types=1);

namespace Game\Chance;

class Chance {
    static function roll(int $chance, ?int $number = null) :bool
    {
        $number = $number ?? rand(1, 100);

        return ($number <= $chance);
    }
}