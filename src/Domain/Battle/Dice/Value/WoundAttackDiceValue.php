<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;
use DiceWar\Domain\Battle\Dice\Effect\EffectWoundDiceValue;

class WoundAttackDiceValue extends AttackDiceValue implements EffectDiceValueInterface
{
    /**
     * @var int
     */
    private $woundDamage;

    /**
     * @var int
     */
    private $woundRounds;

    /**
     * WoundAttackDiceValue constructor.
     *
     * @param int  $power
     * @param int  $woundDamage
     * @param int  $woundRounds
     * @param bool $isInitial
     */
    public function __construct(int $power, int $woundDamage, int $woundRounds, bool $isInitial)
    {
        parent::__construct($power, $isInitial);

        $this->woundDamage = $woundDamage;
        $this->woundRounds = $woundRounds;
    }

    /**
     * {@inheritDoc}
     */
    public function tryOccurred(): void
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    public function isEffectOccurred(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getEffect(): ?EffectDiceValue
    {
        return new EffectWoundDiceValue($this->woundDamage, $this->woundRounds);
    }
}
