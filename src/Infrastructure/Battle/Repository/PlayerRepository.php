<?php

namespace App\Infrastructure\Battle\Repository;

use DiceWar\Domain\Battle\Dice\Value\AttackDiceValue;
use DiceWar\Domain\Battle\Dice\Value\CriticAttackDiceValue;
use DiceWar\Domain\Battle\Dice\Value\DefenseDiceValue;
use DiceWar\Domain\Battle\Dice\Value\StrengthBuffDiceValue;
use DiceWar\Domain\Battle\Dice\Value\WoundAttackDiceValue;
use DiceWar\Domain\Battle\Model\Player;
use DiceWar\Domain\Battle\Dice\Dice;
use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

class PlayerRepository implements \DiceWar\Domain\Battle\Repository\PlayerRepository
{
    /**
     * @param Uuid $playerId
     *
     * @return Player
     */
    public function getPlayer(Uuid $playerId): Player
    {
        return new Player(
            $playerId,
            20,
            30,
            2,
            2,
            new Position(1),
            new DiceCollection([
                new Dice([
                    new WoundAttackDiceValue(0, 1, 3, false),
                    // new StrengthBuffDiceValue(1, 2, false)
                ]),
                new Dice([
                    new BlankDiceValue(),
                    new BlankDiceValue(),
                    new BlankDiceValue(),
                    new BlankDiceValue(),
                    new BlankDiceValue(),
                    new CriticAttackDiceValue(5, 99, true)
                ]),
                new Dice([
                    new AttackDiceValue(2, false),
                    new BlankDiceValue(),
                    new BlankDiceValue(),
                    new AttackDiceValue(3, false),
                    new AttackDiceValue(2, false),
                    new AttackDiceValue(4, true)
                ]),
                new Dice([
                    new AttackDiceValue(2, false),
                    new BlankDiceValue(),
                    new BlankDiceValue(),
                    new AttackDiceValue(1, false),
                    new BlankDiceValue(),
                    new AttackDiceValue(1, true)
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
            10
        );
    }
}
