<?php

use DiceWar\Domain\Battle\Model\Enemy;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';

$handler = new \DiceWar\Application\Battle\Command\StartBattleHandler(
    new \DiceWar\Infrastructure\Battle\Repository\PlayerRepository,
    new \DiceWar\Infrastructure\Battle\Factory\EnemyFactory(),
    new \DiceWar\Infrastructure\Battle\Repository\BattleRepository()
);

$handler->handle(new \DiceWar\Application\Battle\Command\StartBattleCommand(
    Uuid::uuid4(), Uuid::uuid4(), Uuid::uuid4(), Enemy::TYPE_MONSTER
));
