<?php

namespace Kati18\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */
    private $dices;
    private $values;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = null;
        }
        // echo "this->dices:\n";
        // var_dump($this->dices);
        // echo "this->values:\n";
        // var_dump($this->values);
    }

    /**
     * Roll all dices save their value.
     * Uses the method roll in class Dice, see row 49.
     * It also works to use the code on row 48. In that case it replaces the code in row 49.
     *
     * @return void.
     */
    public function roll()
    {
        $this->values = [];
        foreach ($this->dices as $value) {
            // $this->values[] = rand(1, 6);
            $this->values[] = $value->roll();
        }
        // echo "this->values från roll:\n";
        // var_dump($this->values);
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get the sum of all dices in last roll.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        $sum = array_sum($this->values);
        return $sum;
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices in last roll.
     */
    public function average()
    {
        $averageValues = $this->sum()/5;
        return round($averageValues, 1);
    }
}
