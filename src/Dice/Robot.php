<?php
namespace chly19\Dice;

/**
 * Class for robot player.
 */

class Robot extends Player
{
      /**
     * Constructor to initiate robot player.
     *
     * @param int $number       Number of dice in player hand.
     */
    
    public function __construct($number)
    {
        parent::__construct($number);
        $this->randomRollsPerRound = null;
        $this->isThrowingDiceAgain = null;
    }


    /**
     * Determine if the robot will roll the dice again based on probability.
     * 
     * @param int $min      Minimum number of rolls for the current game round.
     * @param int $level    Level to calculate maximum number of rolls for the
     *                      current game round.
     * 
     * @return void
     */

    public function calcIfThrowingDiceAgain($min, $level)
    {
        $max = floor($level / $this->number);
        $this->randomRollsPerRound = rand($min, $max);

        $this->isThrowingDiceAgain = $this->getProbability($this->rollsPerRound + 1) >
            $this->getProbability($this->randomRollsPerRound);
    }


    /**
     * Get the determination for if the robot will roll the dice again based
     * on probability.
     * 
     * @return bool         Determine if the robot will roll the dice again.
     */

    public function isThrowingDiceAgain()
    {
        return $this->isThrowingDiceAgain;
    }


    /**
     * Calculate the probability for not getting 1 in the current game round
     * based on number of dice per roll and current number of rolls added by
     * 1 in the current game round. It is added by 1 to determine if the robot
     * will roll the dice again.
     * 
     * @param int $rollsPerRound        Calculate probability based on total
     *                                  number of dice per round.
     * 
     * @return float                    Probability for not getting 1.
     */

    public function getProbability($rollsPerRound)
    {
        return pow(5, $this->number * $rollsPerRound) /
            pow(6, $this->number * $rollsPerRound);
    }
}
