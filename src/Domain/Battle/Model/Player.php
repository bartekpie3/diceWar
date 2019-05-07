<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Model;

use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

final class Player extends Fighter
{
    /**
     * @var int
     */
    private $energy;

    /**
     * Player constructor.
     *
     * @param Uuid           $playerId
     * @param int            $currentHp
     * @param int            $hp
     * @param int            $strength
     * @param int            $agility
     * @param Position       $position
     * @param DiceCollection $dice
     * @param int            $energy
     */
    public function __construct(
        Uuid $playerId,
        int $currentHp,
        int $hp,
        int $strength,
        int $agility,
        Position $position,
        DiceCollection $dice,
        int $energy
    ) {
        parent::__construct($playerId, $currentHp, $hp, $strength, $agility, $position, $dice);

        $this->energy = $energy;
    }

    /**
     * @return int
     */
    public function energy(): int
    {
        return $this->energy;
    }
}
