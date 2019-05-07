<?php

namespace DiceWar\Domain\Battle\Factory;

use DiceWar\Domain\Battle\Exception\EnemyNotExist;
use DiceWar\Domain\Battle\Model\Enemy;
use Ramsey\Uuid\Uuid;

interface EnemyFactory
{
    /**
     * @param Uuid   $enemyId
     * @param string $enemyType
     *
     * @return Enemy
     *
     * @throws EnemyNotExist
     */
    public function pickEnemy(Uuid $enemyId, string $enemyType): Enemy;
}
