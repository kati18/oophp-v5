<?php
namespace Kati18\Dice;

/**
 * A class that contains the class GameOneHundred.
 * The class contains a method for initiating instances/objects of the class.
 * a method for getting the player object,
 * a method for getting the computer object
*/

class GameOneHundred
{
    /**
     * @var Player $player      The object player
     * @var Player $computer    The object computer
     * @var  $activePlayer      The active player
     */
    private $manPlayer;
    private $computer;
    private $activePlayer = 1;


    /**
     * Constructor for initiating an object of the class
     * GameOneHundred with two objects of the class Player.
     * @return void
     */
    public function __construct()
    {
        $this->manPlayer = new Player("Du");
        $this->computer = new Player("Datorn");
    }


    /**
     * Returns the player object
     *
     * @return object The player
     */
    public function getPlayer()
    {
        return $this->manPlayer;
    }

    /**
     * Returns the computer object
     *
     * @return object The computer
     */
    public function getComputer()
    {
        return $this->computer;
    }

    /**
     * Returns int as value on activePlayer
     *
     * @return int as value on activePlayer
     */
    public function getActivePlayer()
    {
        return $this->activePlayer;
    }

    public function rollPlayer() {
        $this->manPlayer->roll();
    }
}
