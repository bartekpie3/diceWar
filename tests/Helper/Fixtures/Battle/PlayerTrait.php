<?php

namespace Tests\Helper\Fixtures\Battle;

use DiceWar\Domain\Battle\Dice\Dice;
use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use DiceWar\Domain\Battle\Model\Player;
use DiceWar\Domain\Battle\Model\PlayerTest;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

trait PlayerTrait
{
    /**
     * @param int|null $energy
     * @param int|null $hp
     * @param int|null $position
     *
     * @return Player
     *
     * @throws \Exception
     */
    public function createPlayer(?int $energy = null, ?int $hp = null, ?int $position = null): Player
    {
        return new Player(
            Uuid::uuid4(),
            $hp ?? PlayerTest::FIGHTER_HP,
            PlayerTest::FIGHTER_HP,
            PlayerTest::FIGHTER_STRENGTH,
            PlayerTest::FIGHTER_AGILITY,
            new Position($position ?? PlayerTest::FIGHTER_POSITION_ID),
            new DiceCollection([
                new Dice([
                    new BlankDiceValue
                ])
            ]),
            $energy ?? PlayerTest::FIGHTER_ENERGY
        );
    }
}
