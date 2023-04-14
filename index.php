<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'classes/Card.php';
include_once 'classes/Deck.php';
include_once 'classes/GameOne.php';

use classes\GameOne;
print_r('<h1>Card Game</h1>');

try {
    // set number of players and cards per player
//    $a = new
    $game = new GameOne(4, 5);
} catch (Exception $e) {
    print_r($e->getMessage());
}

