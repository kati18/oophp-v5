<?php
namespace Kati18\Dice;

/**
 * A class that contains the class Player.
 * The class contains a method for initiating instances/objects of the class.
 * a method for xxxxxx,
 * a method for xxxxx,
 * a method for xxxxxx.
*/

class Player
{
    /**
     * @var DiceHand            The object dicehand
     * @var int $storedScore    The saved score during a game round (up till the score 100 or more)
     * @var int $tempScore      The temporary score during a turn until a 1 or save
     * @var string $playerName  The name of the player
     */
    private $diceHand;
    private $storedScore;
    private $tempScore;
    private $playerName;


    /**
     * Constructor for initiating an object of the class
     * GameOneHundred with two objects of the class Player.
     * @return void
     */
    public function __construct(string $playerName)
    {
        $this->diceHand = new DiceHand();
        $this->playerName = $playerName;
        $this->storedScore = 0;
        $this->tempScore = 0;
    }


    /**
     * Returns the name of the player
     *
     * @return string as the name of the player
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * Returns the stored score during a game round
     *
     * @return int as storedScore
     */
    public function getStoredScore()
    {
        return $this->storedScore;
    }

    /**
     * Returns the temporary score during a game turn
     *
     * @return int as tempScore
     */
    public function getTempScore()
    {
        return $this->tempScore;
    }

    /**
     * Returns the temporary score during a game turn
     *
     * @return object DiceHand
     */
    public function getDiceHand()
    {
        $this->diceHand->roll();
    }

    /**
     * Returns the temporary score during a game turn
     *
     * @return object DiceHand
     */
    public function roll()
    {
        $this->diceHand->roll();
        // $katja = implode(", ", $this->diceHand->roll());
        // echo $katja;
        if ($this->diceHand->checkRoll()) {
            $this->tempScore = 0;
        } else {
            $this->tempScore += $this->diceHand->sum();
        }
    }
}
