<?php

namespace classes;

use classes\Deck;

class GameOne {
    public $deck;
    public array $players;
    public $numCards;

    /**
     * @throws Exception
     * @oaram $numPlayers in the game
     * @oaram $numCards per player
     */
    function __construct(int $numPlayers, int $numCards)
    {
        $this->numCards = $numCards;

        if ($numPlayers > 8) {
            throw new Exception("Maximum number of players is 8.");
        }
        
        $this->deck = new Deck();
        $this->deck->shuffle();

        $this->printDeckFormatted();

        $this->setPLayers($numPlayers);

        $this->startGame();
    }

    /**
     * Handing out the cards
     */
    protected function startGame() {
        for ($i = 1; $i <= $this->numCards; $i++) {
            foreach ($this->players as &$player) {
                $cards = $this->deck->draw(1);
                $player["cards"] = array_merge($player["cards"], $cards);
            }
        }

        $this->sortCardsByRank();

        $this->printHandingOut();

        $this->printPlayerCards();
    }

    private function setPLayers(int $numPlayers)
    {
        $this->players = [];

        for ($i = 1; $i <= $numPlayers; $i++) {
            $this->players[] = [
                "id" => $i,
                "cards" => [],
            ];
        }
    }

    protected function printHandingOut() {
        $numPlayers = count($this->players);
        echo "<br>";
        echo "<h2>Handing out</h2>";
        for ($i = 0; $i < $numPlayers; $i += 4) {
            for ($j = 0; $j < $this->numCards; $j++) {
                for ($k = 0; $k < 4 && $i + $k < $numPlayers; $k++) {
                    $player = $this->players[$i + $k];
                    echo "Player " . $player["id"] . ": " . $player["cards"][$j] . "\t";
                }
                echo "<br>";
            }
            echo "<br>";
        }
    }

    /**
     * Prints deck after shuffle
     */
    protected function printDeckFormatted() {
        $deck = '';
        foreach ($this->deck->cards as $card) {
            $deck .= $card->__toString(). ", ";
        }
        echo "<h2>Deck</h2>";
        echo $deck;
    }

    /**
     * Format the cards to be human readable
     * @return string
     */
    protected function formatPlayersCards(): string
    {
        $output = "";
        foreach ($this->players as $player) {
            $output .= "Player " . $player["id"] . ": ";
            foreach ($player["cards"] as $card) {
                $output .= $card->__toString() . ", ";
            }
            $output = rtrim($output, ", ") . "<br>";
        }
        return $output;
    }

    protected function printPlayerCards()
    {
        echo "<h2>Players Cards</h2>";
        print_r($this->formatPlayersCards());
    }

    private function sortCardsByRank()
    {
        foreach ($this->players as &$player) {
            usort($player["cards"], function($a, $b) {
                return $a->rank - $b->rank;
            });
        }
    }
}
