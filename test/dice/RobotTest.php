<?php

namespace chly19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Robot.
 */

class RobotTest extends TestCase
{
    /**
     * Create new instance of Robot class with random number of dice per roll.
     */

    public function setUp(): void
    {
        $this->number = rand(1, 4);
        $this->robot = new Robot($this->number);
        $this->rollsPerRound = rand(1, 3);
        $this->roundSum = 0;
        $this->totalSum = 0;

        for ($i = 0; $i < $this->rollsPerRound; $i++) {
            $this->robot->roll();
            $this->values = $this->robot->values();
            $this->robot->calcRoundGraphic();
            $this->robot->calcRoundSum();
            for ($j = 0; $j < $this->number; $j++) {
                $this->roundSum += $this->values[$j];
            }
        }

        $this->robot->calcTotalSum();
        $this->totalSum += $this->roundSum;
    }


    /**
     * Test that robot object is an instance of Robot class.
     */

    public function testObjectIsInstanceOfRobot()
    {
        $this->assertInstanceOf("\chly19\Dice\Robot", $this->robot);
    }


    /**
     * Check that the number of dice per roll is correct.
     */

    public function testNumberOfDices()
    {
        $this->assertEquals($this->number, count($this->values));
        $this->assertEquals($this->number, count($this->robot->graphic));
    }


    /**
     * Test if one of the rolled dice in current roll is 1.
     */

    public function testValueIsOne()
    {
        $valueIsOne = null;
        for ($i = 0; $i < $this->number; $i++) {
            if ($this->values[$i] == 1) {
                $valueIsOne = true;
            }
        }
        $this->assertEquals($this->robot->valueIsOne(), $valueIsOne);
    }


    /**
     * Test that number of rolls for current round is correct.
     */

    public function testNumberOfRollsPerRound()
    {
        $this->assertEquals($this->rollsPerRound, $this->robot->rollsPerRound());
        $this->assertEquals($this->rollsPerRound, count($this->robot->getRoundGraphic()));
    }


    /**
     * Test that the determination is correct for if the robot will roll the
     * dice again based on probability.
     */

    public function testIsThrowingDiceAgain()
    {
        $min = 1;
        $level = 12;
        $this->robot->calcIfThrowingDiceAgain($min, $level);

        $isThrowingDiceAgain = (pow(5, $this->number * ($this->rollsPerRound + 1)) /
            pow(6, $this->number * ($this->rollsPerRound + 1))) >
            (pow(5, $this->number * $this->robot->randomRollsPerRound) /
            pow(6, $this->number * $this->robot->randomRollsPerRound));

        $this->assertEquals($isThrowingDiceAgain, $this->robot->isThrowingDiceAgain());
    }


    /**
     * Test that the round sum is correct.
    */

    public function testRoundSum()
    {
        $this->assertEquals($this->robot->getRoundSum(), $this->roundSum);
    }


    /**
     * Test that the total sum is correct.
     */

    public function testTotalSum()
    {
        $this->assertEquals($this->robot->getTotalSum(), $this->totalSum);
    }
}
