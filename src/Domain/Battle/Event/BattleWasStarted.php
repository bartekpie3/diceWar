<?php

namespace DiceWar\Domain\Battle\Event;

use DiceWar\Domain\Battle\Model\Enemy;
use DiceWar\Domain\Battle\Model\Player;
use Ramsey\Uuid\Uuid;

class BattleWasStarted
{
    /**
     * @var Uuid
     */
    private $battleId;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var Enemy
     */
    private $enemy;

    /**
     * BattleWasStarted constructor.
     *
     * @param Uuid   $battleId
     * @param Player $player
     * @param Enemy  $enemy
     */
    public function __construct(Uuid $battleId, Player $player, Enemy $enemy)
    {
        $this->battleId = $battleId;
        $this->player = $player;
        $this->enemy = $enemy;
    }

    /**
     * @return Uuid
     */
    public function getBattleId(): Uuid
    {
        return $this->battleId;
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
}
