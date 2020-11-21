<?php
namespace chly19\Dice;

/**
 * Graphic representation of a dice.
 */

class DiceGraphic extends Dice
{
    const SIDES = 6;

    /**
     * Constructor for sides of the dice.
     */

    public function __construct()
    {
        parent::__construct(self::SIDES);
    }


    /**
     * Graphic representation of a dice.
     */

    public function graphic()
    {
        if ($this->value == 1) {
            return "one";
        } else if ($this->value == 2) {
            return "two";
        } else if ($this->value == 3) {
            return "three";
        } else if ($this->value == 4) {
            return "four";
        } else if ($this->value == 5) {
            return "five";
        }
        return "six";
    }
}
