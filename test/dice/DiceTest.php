<?php

namespace chly19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Create new instance of Dice class with random number of sides (6-20).
     */

    public function setUp(): void
    {
        $this->sides = rand(6, 20);
        $this->dice = new Dice($this->sides);
        $this->dice->roll();
    }


    /**
     * Test that dice object is an instance of Dice class.
     */

    public function testObjectIsInstanceOfDice()
    {
        $this->assertInstanceOf("\chly19\Dice\Dice", $this->dice);
    }


    /**
     * Test that the rolled dice is greater or equal to 1 and less than or equal
     * to $sides.
     */

    public function testValueInterval()
    {
        $this->assertGreaterThanOrEqual(1, $this->dice->value());
        $this->assertLessThanOrEqual($this->sides, $this->dice->value());
    }


    /**
     * Test that number of sides is correct.
     */

    public function testSides()
    {
        $this->assertEquals($this->sides, $this->dice->sides);
    }
}
