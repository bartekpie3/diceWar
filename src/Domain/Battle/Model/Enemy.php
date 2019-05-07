<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Model;

use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

final class Enemy extends Fighter
{
    const TYPE_PLAYER = 'player';
    const TYPE_MONSTER = 'monster';

    const CLASS_UNDEAD = 'undead';
    const CLASS_BEAST = 'beast';
    const CLASS_HUMAN = 'human';
    const CLASS_ORK = 'ork';
    const CLASS_ELF = 'elf';
    const CLASS_DWARF = 'dwarf';
    const CLASS_VAMPIRE = 'vampire';

    /**
     * @var string
     */
    private $type;

    /**
     * Enemy constructor.
     *
     * @param Uuid           $enemyId
     * @param int            $currentHp
     * @param int            $hp
     * @param int            $strength
     * @param int            $agility
     * @param Position       $position
     * @param DiceCollection $dice
     * @param string         $type
     */
    public function __construct(
        Uuid $enemyId,
        int $currentHp,
        int $hp,
        int $strength,
        int $agility,
        Position $position,
        DiceCollection $dice,
        string $type
    ) {
        parent::__construct($enemyId, $currentHp, $hp, $strength, $agility, $position, $dice);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }
}
