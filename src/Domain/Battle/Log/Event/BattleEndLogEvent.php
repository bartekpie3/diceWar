<?php

namespace DiceWar\Domain\Battle\Log\Event;

use DiceWar\Domain\Battle\Model\Fighter;

class BattleEndLogEvent extends LogEvent
{
    /**
     * @var Fighter|null
     */
    private $winner;

    /**
     * BattleEndLogEvent constructor.
     *
     * @param Fighter|null $winner
     */
    public function __construct(?Fighter $winner = null)
    {
        $this->winner = $winner;
    }

    /**
     * @return Fighter|null
     */
    public function getWinner(): ?Fighter
    {
        return $this->winner;
    }

    /**
     * @return bool
     */
    public function isDraw(): bool
    {
        return $this->winner === null;
    }
}
