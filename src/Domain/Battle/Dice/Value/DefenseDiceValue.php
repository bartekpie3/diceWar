<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

class DefenseDiceValue extends DiceValue
{
    /**
     * @var int
     */
    private $defense;

    /**
     * CommonAttack constructor.
     *
     * @param int  $defense
     * @param bool $isInitial
     */
    public function __construct(int $defense, bool $isInitial)
    {
        parent::__construct($isInitial);

        $this->defense = $defense;
    }

    /**
     * {@inheritDoc}
     */
    public function isAttack(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function isDefense(): bool
    {
        return true;
    }

    /**
     * @return int
     */
    public function defense(): int
    {
        return $this->defense;
    }
}
