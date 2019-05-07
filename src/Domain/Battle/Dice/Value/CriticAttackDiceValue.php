<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;

class CriticAttackDiceValue extends AttackDiceValue implements EffectDiceValueInterface
{
    /**
     * @var int
     */
    private $criticChance;

    /**
     * @var bool
     */
    private $isCritic = false;

    /**
     * CriticAttackDiceValue constructor.
     *
     * @param int  $power
     * @param int  $criticChance
     * @param bool $isInitial
     */
    public function __construct(int $power, int $criticChance, bool $isInitial)
    {
        parent::__construct($power, $isInitial);

        $this->criticChance = $criticChance;
    }

    /**
     * {@inheritDoc}
     */
    public function power(): int
    {
        return $this->power + $this->criticDamage();
    }

    /**
     * @return int
     */
    private function criticDamage(): int
    {
        return $this->isCritic ? (int) floor($this->power / 2) : 0;
    }

    /**
     * {@inheritDoc}
     */
    public function tryOccurred(): void
    {
        $this->isCritic = mt_rand(1, 100) <= $this->criticChance;
    }

    /**
     * {@inheritDoc}
     */
    public function isEffectOccurred(): bool
    {
        return $this->isCritic;
    }

    /**
     * {@inheritDoc}
     */
    public function getEffect(): ?EffectDiceValue
    {
        return null;
    }
}
