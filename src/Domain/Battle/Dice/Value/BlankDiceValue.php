<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

class BlankDiceValue extends DiceValue
{
    /**
     * BlankDiceValue constructor.
     */
    public function __construct()
    {
        parent::__construct(false);
    }

    /**
     * @return bool
     */
    public function isAttack(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isDefense(): bool
    {
        return false;
    }
}
