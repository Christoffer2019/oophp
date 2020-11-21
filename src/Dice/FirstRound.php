<?php
namespace chly19\Dice;

/**
 * Class for determining which player that will start the game, by rolling
 * a dice. The player that has the highest number will start.
 */
class FirstRound
{
      /**
     * Constructor for creating players and array of values from the rolled
     * dices.
     *
     * @param int $numberOfDices        Number of dices per player.
     * @param int $numberOfPlayers      Number of players in the game.
     */
    
    public function __construct(int $numberOfDices = 1, int $numberOfPlayers = 2)
    {
        $this->numberOfDices = $numberOfDices;
        $this->numberOfPlayers = $numberOfPlayers;
        $this->players = [];
        $this->values = [];
        
        for ($i = 0; $i < $this->numberOfPlayers; $i++) {
            $this->players[] = new Player($numberOfDices);
            $this->values[] = null;
        }
    }


    /**
     * Roll dices for all players and save the values.
     *
     * @return void
     */
    
    public function roll()
    {
        for ($i = 0; $i < $this->numberOfPlayers; $i++) {
            $this->players[$i]->roll();
            $this->values[$i] = $this->players[$i]->values();
        }
    }


    /**
     * Get the index for the player that has the highest number.
     * 
     * @return int $maxPlayer       The index for the player that
     *                              has the highest number.
     */

    public function compare()
    {
        for ($i = 0; $i < $this->numberOfPlayers; $i++) {
            $sumValues[] = array_sum($this->values[$i]);
        }
        $maxValue = max($sumValues);
        $maxPlayer = array_search($maxValue, $sumValues);
        return $maxPlayer;
    }
}
