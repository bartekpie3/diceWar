<?php

namespace App\Application\Battle\Command;

use DiceWar\Domain\Battle\Model\Enemy;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

final class StartBattleCommand
{
    /**
     * @var Uuid
     */
    private $battleId;

    /**
     * @var Uuid
     */
    private $playerId;

    /**
     * @var Uuid
     */
    private $enemyId;

    /**
     * @var string
     */
    private $enemyType;

    /**
     * StartBattleCommand constructor.
     *
     * @param Uuid   $battleId
     * @param Uuid   $playerId
     * @param Uuid   $enemyId
     * @param string $enemyType
     */
    public function __construct(Uuid $battleId, Uuid $playerId, Uuid $enemyId, string $enemyType)
    {
        if (! in_array($enemyType, [Enemy::TYPE_MONSTER, Enemy::TYPE_PLAYER])) {
            throw new InvalidArgumentException(sprintf(
                'Invalid enemyType - possible types: %s, %s',
                Enemy::TYPE_MONSTER,
                Enemy::TYPE_PLAYER
            ));
        }

        $this->battleId = $battleId;
        $this->playerId = $playerId;
        $this->enemyId  = $enemyId;
        $this->enemyType = $enemyType;
    }

    /**
     * @return Uuid
     */
    public function getBattleId(): Uuid
    {
        return $this->battleId;
    }

    /**
     * @return Uuid
     */
    public function getPlayerId(): Uuid
    {
        return $this->playerId;
    }

    /**
     * @return Uuid
     */
    public function getEnemyId(): Uuid
    {
        return $this->enemyId;
    }

    /**
     * @return string
     */
    public function getEnemyType(): string
    {
        return $this->enemyType;
    }
}
