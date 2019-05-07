<?php

namespace App\Infrastructure\Battle\Factory;

use DiceWar\Domain\Battle\Dice\Value\AttackDiceValue;
use DiceWar\Domain\Battle\Dice\Value\DefenseDiceValue;
use DiceWar\Domain\Battle\Model\Enemy;
use DiceWar\Domain\Battle\Dice\Dice;
use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

class EnemyFactory implements \DiceWar\Domain\Battle\Factory\EnemyFactory
{
    /**
     * @param Uuid   $enemyId
     * @param string $enemyType
     *
     * @return Enemy
     */
    public function pickEnemy(Uuid $enemyId, string $enemyType): Enemy
    {
        switch ($enemyType) {
            default:
                return new Enemy(
                    $enemyId,
                    15,
                    15,
                    3,
                    2,
                    new Position(1),
                    new DiceCollection([
                        new Dice([
                            new AttackDiceValue(2, true),
                            new BlankDiceValue(),
                            new AttackDiceValue(1, true),
                            new AttackDiceValue(3, true),
                            new DefenseDiceValue(2, false),
                            new DefenseDiceValue(2, false),
                        ]),
                        new Dice([
                            new AttackDiceValue(2, true),
                            new BlankDiceValue(),
                            new BlankDiceValue(),
                            new AttackDiceValue(1, true),
                        ]),
                        new Dice([
                            new DefenseDiceValue(2, false),
                            new BlankDiceValue(),
                            new BlankDiceValue(),
                            new DefenseDiceValue(1, false),
                            new BlankDiceValue(),
                            new DefenseDiceValue(1, true)
                        ]),
                        new Dice([
                            new DefenseDiceValue(2, false),
                            new BlankDiceValue(),
                            new BlankDiceValue(),
                            new DefenseDiceValue(1, false),
                            new BlankDiceValue(),
                            new DefenseDiceValue(1, true)
                        ]),
                    ]),
                    Enemy::TYPE_MONSTER
                );
        }
    }
}
