<?php
namespace chly19\Dice;

/**
 * Class for rolling dice.
 */

class Dice
{
      /**
     * Constructor for value and sides of the dice.
     *
     * int $value           The rolled dice
     * @param int $sides    Number of sides for the dice.
     */
    
    public function __construct(int $sides = 6)
    {
        $this->value = 0;
        $this->sides = $sides;
    }


    /**
     * Roll dice
     *
     * @return void
     */
    
    public function roll()
    {
        $this->value = rand(1, $this->sides);
    }


    /**
     * Get the value of the rolled dice.
     *
     * @return $value The value of the rolled dice
     */
    
    public function value()
    {
        return $this->value;
    }
}
