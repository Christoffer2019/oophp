<?php

namespace chly19\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class ClearPropertiesInPlayerTest extends TestCase
{
    /**
     * Create new instance of Player class with random number of dice per roll.
     */

    public function setUp(): void
    {
        $this->player = new Player(rand(1, 4));
        $this->rollsPerRound = rand(1, 4);

        for ($i = 0; $i < $this->rollsPerRound; $i++) {
            $this->player->roll();
            $this->player->values();
            $this->player->calcRoundGraphic();
            $this->player->calcRoundSum();
        }
    }


    /**
     * Clear sum and number of rolls for the current game round. Test that
     * these properties are empty.
     */

    public function testClearRound()
    {
        $this->player->clearRound();
        $this->assertEquals(0, $this->player->getRoundSum());
        $this->assertEquals(0, $this->player->rollsPerRound());
    }


    /**
     * Clear graphic representation for all dices in the current game round.
     * Test that this property is cleared.
     */

    public function testClearRoundGraphic()
    {
        $this->player->clearRoundGraphic();
        $this->assertEquals([], $this->player->getRoundGraphic());
    }
}
