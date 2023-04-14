<?php
namespace classes;

/**
 * Basic Class Card
 * @package classes
 */
class Card {
    public $suit;
    public $rank;

    function __construct($suit, $rank) {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function faceCard() {
        return $this->rank > 10;
    }

    /**
     * Turns the ranks to string (A, J, Q, K) and return sting with combined rank + suit
     * @return string
     */
    public function __toString() {
        $rankStr = "";
        switch ($this->rank) {
            case 1:
                $rankStr = "Ace";
                break;
            case 11:
                $rankStr = "Jack";
                break;
            case 12:
                $rankStr = "Queen";
                break;
            case 13:
                $rankStr = "King";
                break;
            default:
                $rankStr = strval($this->rank);
                break;
        }
        return $rankStr . " of " . ucfirst($this->suit);
    }

    function compare(Card $otherCard) {
        return $this->rank - $otherCard->rank;
    }
}