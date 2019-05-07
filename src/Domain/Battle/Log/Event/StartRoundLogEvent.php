<?php

namespace DiceWar\Domain\Battle\Log\Event;

use DiceWar\Domain\Battle\Model\Enemy;
use DiceWar\Domain\Battle\Model\Player;

class StartRoundLogEvent extends LogEvent
{
    /**
     * @var int
     */
    private $roundNumber;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var Enemy
     */
    private $enemy;

    /**
     * StartRoundLogEvent constructor.
     *
     * @param int    $roundNumber
     * @param Player $player
     * @param Enemy  $enemy
     */
    public function __construct(int $roundNumber, Player $player, Enemy $enemy)
    {
        $this->roundNumber = $roundNumber;
        $this->player = $player;
        $this->enemy = $enemy;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return Enemy
     */
    public function getEnemy(): Enemy
    {
        return $this->enemy;
    }

    /**
     * @return int
     */
    public function getRoundNumber(): int
    {
        return $this->roundNumber;
    }
}
