<?php

use \Game\Character\Hero as Hero;
use \Game\Character\Beast as Beast;
use \Game\Role\RoleSetter as RoleSetter;
use \Game\Game as Game;
use \Game\Log\Logger as Logger;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../../vendor/autoload.php';

$game = new Game(new Hero, new Beast, new RoleSetter);
$game->play();

header('Content-Type: application/json');
echo Logger::instance()->getJSON();
exit();