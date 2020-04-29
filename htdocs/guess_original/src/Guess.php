<?php
/**
 * Guess my number, a class supporting the game through POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number = null;
    private $tries = 6;
    // Below should also work:
    // private $number;
    // private $tries;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number === -1) {
            // $number = rand(1, 100);
            // Mitt tillägg:
            $number = $this->random();
        }
        $this->number = $number;
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return int
     */
    // public function random() : void
    public function random() : int
    {
        // $this->number = rand(1, 100);
        //Mitt tillägg:
        // $randNumber = rand(1, 100);
        // return $randNumber;
        //alt.
        return rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries() : int
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number() : int
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess(int $guess) : string
    {
        if (!(is_int($guess) && $guess > 0 && $guess < 101)) {
            throw new GuessException("Sorry, your guess can only be an integer between 1 and 100.");
        }

        $this->tries--;

        if ($guess === $this->number) {
            return $res = " CORRECT";
        } elseif ($guess > $this->number) {
            return $res = "  TOO HIGH";
        } else {
            return $res = " TOO LOW";
        }
    }
}
