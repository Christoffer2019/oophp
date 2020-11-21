<?php

namespace chly19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class FirstRound.
 */
class FirstRoundTest extends TestCase
{
    /**
     * Create new instance of FirstRound class.
     */

    public function setUp(): void
    {
        $this->numberOfPlayers = 2;
        $this->firstRound = new FirstRound(1, $this->numberOfPlayers);
        $this->firstRound->roll();
    }


    /**
     * Test that firstRound object is an instance of FirstRound class.
     */

    public function testObjectIsInstanceOfFirstRound()
    {
        $this->assertInstanceOf("\chly19\Dice\FirstRound", $this->firstRound);
    }


    /**
     * Test that the number of players is correct.
     */

    public function testNumberOfPlayers()
    {
        $this->assertEquals($this->numberOfPlayers, $this->firstRound->numberOfPlayers);
    }


    /**
     * Test that the index for the player that has the highest number is correct.
     */

    public function testCompare()
    {
        for ($i = 0; $i < $this->numberOfPlayers; $i++) {
            $sumValues[] = array_sum($this->firstRound->values[$i]);
        }
        $maxValue = max($sumValues);
        $maxPlayer = array_search($maxValue, $sumValues);
        
        $this->assertEquals($maxPlayer, $this->firstRound->compare());
    }
}
