<?php

namespace chly19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Create new instance of Player class with random number of dice per roll.
     */

    public function setUp(): void
    {
        $this->number = rand(1, 4);
        $this->player = new Player($this->number);
        $this->rollsPerRound = rand(1, 3);
        $this->roundSum = 0;
        $this->totalSum = 0;

        for ($i = 0; $i < $this->rollsPerRound; $i++) {
            $this->player->roll();
            $this->values = $this->player->values();
            $this->player->calcRoundGraphic();
            $this->player->calcRoundSum();
            for ($j = 0; $j < $this->number; $j++) {
                $this->roundSum += $this->values[$j];
            }
        }

        $this->player->calcTotalSum();
        $this->totalSum += $this->roundSum;
    }


    /**
     * Test that player object is an instance of Player class.
     */

    public function testObjectIsInstanceOfPlayer()
    {
        $this->assertInstanceOf("\chly19\Dice\Player", $this->player);
    }


    /**
     * Check that the number of dice per roll is correct.
     */

    public function testNumberOfDices()
    {
        $this->assertEquals($this->number, count($this->values));
        $this->assertEquals($this->number, count($this->player->graphic));
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
        $this->assertEquals($this->player->valueIsOne(), $valueIsOne);
    }


    /**
     * Test that number of rolls for current round is correct.
     */

    public function testNumberOfRollsPerRound()
    {
        $this->assertEquals($this->rollsPerRound, $this->player->rollsPerRound());
        $this->assertEquals($this->rollsPerRound, count($this->player->getRoundGraphic()));
    }


    /**
     * Test that robot algorithm is correct.
     */
/*
    public function testRobotAlgorithm()
    {
        $min = 1;
        $level = 12;
        $this->player->calcRobotAlgorithm($min, $level);

        $algorithm = (pow(5, $this->number * ($this->rollsPerRound + 1)) /
            pow(6, $this->number * ($this->rollsPerRound + 1))) >
            (pow(5, $this->number * $this->player->randomRollsPerRound) /
            pow(6, $this->number * $this->player->randomRollsPerRound));

        $this->assertEquals($algorithm, $this->player->getRobotAlgorithm());
    }
*/

    /**
     * Test that the round sum is correct.
    */

    public function testRoundSum()
    {
        $this->assertEquals($this->player->getRoundSum(), $this->roundSum);
    }


    /**
     * Test that the total sum is correct.
     */

    public function testTotalSum()
    {
        $this->assertEquals($this->player->getTotalSum(), $this->totalSum);
    }
}
