<?php
declare(strict_types=1);

namespace Game\Log;

class Logger {
    private static $instance;
    private $log;

    public function log(string $text, $key = 'gameplay')
    {
        $this->log[$key][] = $text;

        return $this;
    }

    public function logStats(array $stats, string $character)
    {
        $this->log['stats'][$character] = json_encode($stats);

        return $this;
    }

    public function getJSON() :string
    {
        return json_encode($this->log);
    }

    public static function instance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}