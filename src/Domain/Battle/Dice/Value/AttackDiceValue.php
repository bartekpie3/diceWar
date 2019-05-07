<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

class AttackDiceValue extends DiceValue
{
    /**
     * @var int
     */
    protected $power;

    /**
     * CommonAttack constructor.
     *
     * @param int  $power
     * @param bool $isInitial
     */
    public function __construct(int $power, bool $isInitial)
    {
        parent::__construct($isInitial);

        $this->power = $power;
    }

    /**
     * {@inheritDoc}
     */
    public function isAttack(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isDefense(): bool
    {
        return false;
    }

    /**
     * @return int
     */
    public function power(): int
    {
        return $this->power;
    }
}
