<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;

class DoubleAttackDiceValue extends AttackDiceValue implements EffectDiceValueInterface
{
    /**
     * @var int
     */
    private $doubleChance;

    /**
     * @var bool
     */
    private $isDouble = false;

    /**
     * CriticAttackDiceValue constructor.
     *
     * @param int  $power
     * @param int  $doubleChance
     * @param bool $isInitial
     */
    public function __construct(int $power, int $doubleChance, bool $isInitial)
    {
        parent::__construct($power, $isInitial);

        $this->doubleChance = $doubleChance;
    }

    /**
     * {@inheritDoc}
     */
    public function power(): int
    {
        return $this->power + $this->doubleDamage();
    }

    /**
     * @return int
     */
    private function doubleDamage(): int
    {
        return $this->isDouble ? $this->power : 0;
    }

    /**
     * {@inheritDoc}
     */
    public function tryOccurred(): void
    {
        $this->isDouble = mt_rand(1, 100) <= $this->doubleChance;
    }

    /**
     * {@inheritDoc}
     */
    public function isEffectOccurred(): bool
    {
        return $this->isDouble;
    }

    /**
     * {@inheritDoc}
     */
    public function getEffect(): ?EffectDiceValue
    {
        return null;
    }
}
