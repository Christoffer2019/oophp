<?php

namespace chly19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceGraphic.
 */
class DiceGraphicTest extends TestCase
{
    /**
     * Create new instance of DiceGraphic class with 6 sides.
     */

    public function setUp(): void
    {
        $this->diceGraphic = new DiceGraphic(6);
        $this->diceGraphic->roll();
        $this->value = $this->diceGraphic->value();
    }


    /**
     * Test that diceGraphic object is an instance of DiceGraphic class.
     */

    public function testObjectIsInstanceOfDiceGraphic()
    {
        $this->assertInstanceOf("\chly19\Dice\DiceGraphic", $this->diceGraphic);
    }


    /**
     * Test that the rolled dice is greater or equal to 1 and less than or equal
     * to 6.
     */

    public function testValueInterval()
    {
        $this->assertGreaterThanOrEqual(1, $this->value);
        $this->assertLessThanOrEqual(6, $this->value);
    }


    /**
     * Test that number of sides is correct.
     */

    public function testSides()
    {
        $this->assertEquals(6, $this->diceGraphic->sides);
    }


    /**
     * Test that graphic representation of dice is correct.
     */

    public function testGraphic()
    {
        if ($this->value == 1) {
            $this->graphic = "one";
        } else if ($this->value == 2) {
            $this->graphic = "two";
        } else if ($this->value == 3) {
            $this->graphic = "three";
        } else if ($this->value == 4) {
            $this->graphic = "four";
        } else if ($this->value == 5) {
            $this->graphic = "five";
        } else {
            $this->graphic = "six";
        }

        $this->assertEquals($this->graphic, $this->diceGraphic->graphic());
    }
}
