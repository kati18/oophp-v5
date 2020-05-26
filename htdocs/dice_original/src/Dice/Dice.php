<?php
namespace Kati18\Dice;

/**
 * A class that contains the class Dice.
 * The class contains a method for initiating instances/objects of the class,
 * a method for rolling the dice,
 * a method for calculating the sum of all values of the rolls,
 * a method for calculation the average value of all the rolls.
*/

class Dice
{
    /**
     * @var int $sides   The value on the dice
     * @var int $lastRoll The value on the dice last rolled
     */
    private $sides;
    private $lastRoll;
    // alt.:
    // protected $lastRoll;


    /**
     * Constructor to initiate the object with sides that defaults to 6 if no
     * argument is passed in.
     *
     * @param int $sides The number of sides of the dice, default 6.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }


    /**
     * Rolls the dice and randomizes a dice face which is an integer between 1 and 6.
     *
     * @return int as number of dice face
     */
    public function roll()
    {
        $side = rand(1, 6);
        $this->lastRoll = $side;
        return $side;
    }


    /**
     * Gets the value on dice from the last roll.
     *
     * @return int as value of the dice
     */
    public function getLastRoll()
    {
        // $lastRoll = $this->lastRoll;
        // return $lastRoll;
        // alt.:
        return $this->lastRoll;
    }


    /**
     * Summarizes all values(elements) in the array $arrayValues.
     *
     * @return int as sum of all values in the array $$arrayValues.
     */
    public function sum(array $arrayValues)
    {
        $sum = array_sum($arrayValues);
        return $sum;
    }

    /**
     * Calculates the average value of all values(elements) in the array $arrayValues.
     *
     * @return int as the average value of all values in the array $arrayValues.
     */
    public function average(array $arrayValues)
    {
        $sum = $this->sum($arrayValues);
        $average = $sum/6;
        return round($average, 1);
    }
}
