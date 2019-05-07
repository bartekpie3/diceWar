<?php

namespace DiceWar\Domain\Battle\Log\Event;

use DiceWar\Domain\Battle\Dice\RoundDice;

class RollDiceLogEvent extends LogEvent
{
    /**
     * @var RoundDice
     */
    private $playerDice;

    /**
     * @var RoundDice
     */
    private $enemyDice;

    /**
     * RollDiceLogEvent constructor.
     *
     * @param RoundDice $playerDice
     * @param RoundDice $enemyDice
     */
    public function __construct(RoundDice $playerDice, RoundDice $enemyDice)
    {
        $this->playerDice = $playerDice;
        $this->enemyDice = $enemyDice;
    }

    /**
     * @return RoundDice
     */
    public function getPlayerDice(): RoundDice
    {
        return $this->playerDice;
    }

    /**
     * @return RoundDice
     */
    public function getEnemyDice(): RoundDice
    {
        return $this->enemyDice;
    }
}
