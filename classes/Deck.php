<?php

namespace classes;

use classes\Card;

/**
 * Class Deck
 * @package classes
 */
class Deck {
    public array $cards;

    function __construct() {
        $this->cards = [];
        $suits = ["hearts", "diamonds", "spades", "clubs"];
        // $suits = ["&hearts;", "&diams;", "&spades;", "&clubs;"];
        foreach ($suits as $suit) {
            for ($rank = 1; $rank <= 13; $rank++) {
                $card = new Card($suit, $rank);
                $this->cards[] = $card;
            }
        }
    }

    function count(): int
    {
        return count($this->cards);
    }

    /**
     * Shuffle the cards in deck
     */
    public function shuffle() {
        shuffle($this->cards);
    }

    /**
     * Draw a card/s from deck
     * @param int $n
     * @return array
     */
    public function draw(int $n = 1): array
    {
        $result = [];
        for ($i = 1; $i <= $n; $i++) {
            $card = array_pop($this->cards);
            $result[] = $card;
        }
        
        return $result;
    }
}