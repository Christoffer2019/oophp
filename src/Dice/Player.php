<?php
namespace chly19\Dice;

/**
 * Class for player.
 */
class Player
{
      /**
     * Constructor to initiate player.
     *
     * @param int $number       Number of dices in player hand.
     */
    
    public function __construct($number)
    {
        $this->number = $number;
        $this->roundSum = 0;
        $this->totalSum = 0;
        $this->rollsPerRound = 0;
        $this->dices = [];
        $this->values = [];
        $this->graphic = [];
        $this->roundGraphic = [];

        for ($i = 0; $i < $this->number; $i++) {
            $this->dices[] = new DiceGraphic();
            $this->values[] = null;
            $this->graphic[] = null;
        }
    }


    /**
     * Roll dices and count number of rolls for current game round.
     *
     * @return void
     */
    
    public function roll()
    {
        for ($i = 0; $i < $this->number; $i++) {
            $this->dices[$i]->roll();
        }
        $this->rollsPerRound += 1;
    }


    /**
     * Get the values for the rolled dices.
     *
     * @return array $values        The rolled dices
     */
    
    public function values()
    {
        for ($i = 0; $i < $this->number; $i++) {
            $this->values[$i] = $this->dices[$i]->value();
        }
        return $this->values;
    }


    /**
     * Check if one of the rolled dices in current roll is 1.
     * 
     * @return bool|null    If one of the rolled dices in current roll is 1,
     *                      then return true. Otherwise return null.
     */

    public function valueIsOne()
    {
        for ($i = 0; $i < $this->number; $i++) {
            if ($this->values[$i] == 1) {
                return true;
            } 
        }
        return null;
    }


    /**
     * Save graphic representation for the dices in current roll and all rolls
     * in the current round.
     *
     * @return void
     */
    
    public function calcRoundGraphic()
    {
        for ($i = 0; $i < $this->number; $i++) {
            $this->graphic[$i] = $this->dices[$i]->graphic();
        }
        $this->roundGraphic[] = $this->graphic;
    }


    /**
     * Get graphic representation for all rolls in the current round.
     * 
     * @return array $roundGraphic      Array containing graphic representation
     *                                  for all rolls in the current round
     */

    public function getRoundGraphic()
    {
        return $this->roundGraphic;
    }


    /**
     * Clear graphic representation for all dices in the current game round.
     * 
     * @return void
     */

    public function clearRoundGraphic()
    {
        $this->roundGraphic = [];
    }


    /**
     * Get number of rolls in current game round.
     * 
     * @return int $rollsPerRound   Number of rolls in current game round.
     */

    public function rollsPerRound()
    {
        return $this->rollsPerRound;
    }


    /**
     * Clear sum and number of rolls for the current game round.
     * 
     * @return void
     */

    public function clearRound()
    {
        $this->roundSum = 0;
        $this->rollsPerRound = 0;
    }


    /**
     * Calculate the sum of the rolled dices for the current roll.
     *
     * @return void
     */
    
    public function calcRoundSum()
    {
        for ($i = 0; $i < $this->number; $i++) {
            $this->roundSum += $this->values[$i];
        }
    }


    /**
     * Get the sum of the rolled dices for the current roll.
     *
     * @return int $roundSum    The sum of the rolled dices for the current
     *                          roll.
     */
    
    public function getRoundSum()
    {
        return $this->roundSum;
    }


    /**
     * Calculate the total sum for the game.
     *
     * @return void
     */
    
    public function calcTotalSum()
    {
        $this->totalSum += $this->roundSum;
    }


    /**
     * Get the total sum for the game.
     *
     * @return int $totalSum        The total sum for the game.
     */
    
    public function getTotalSum()
    {
        return $this->totalSum;
    }
}
