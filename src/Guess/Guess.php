<?php
namespace chly19\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */



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
        $this->number = $number;
        $this->tries = $tries;
    }
    



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    
    public function random()
    {
        $this->number = rand(1, 100);
    }
    



    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    
    public function tries()
    {
        return $this->tries;
    }
    



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    
    public function number()
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
    
    public function makeGuess($number)
    {
        try {
            if ((!is_numeric($number)) || $number > 100 || $number < 1) {
                throw new GuessException("<h4 class='red'>Only integers " .
                    "1 - 100 are allowed.</h4>");
            }

            $this->tries = $this->tries - 1;
            if ($this->tries == 0) {
                return "<h4 class='red'>You lost!</h4>";
            } else if ($number > $this->number) {
                return "<h4>Your guess is too high!</h4>";
            } else if ($number < $this->number) {
                return "<h4>Your guess is too low!</h4>";
            } else {
                return "<h4 class='blue'>You won!</h4>";
            }
        } catch (GuessException $e) {
            return $e->getMessage();
        }
    }
}
