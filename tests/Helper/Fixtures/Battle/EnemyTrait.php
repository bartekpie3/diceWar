<?php

namespace Tests\Helper\Fixtures\Battle;

use DiceWar\Domain\Battle\Dice\Dice;
use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use DiceWar\Domain\Battle\Model\Enemy;
use DiceWar\Domain\Battle\Model\EnemyTest;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

trait EnemyTrait
{
    public function createEnemy(): Enemy
    {
        return new Enemy(
            Uuid::uuid4(),
            EnemyTest::FIGHTER_HP,
            EnemyTest::FIGHTER_HP,
            EnemyTest::FIGHTER_STRENGTH,
            EnemyTest::FIGHTER_AGILITY,
            new Position(EnemyTest::FIGHTER_POSITION_ID),
            new DiceCollection([
                new Dice([
                    new BlankDiceValue
                ])
            ]),
            EnemyTest::ENEMY_TYPE
        );
    }
}
