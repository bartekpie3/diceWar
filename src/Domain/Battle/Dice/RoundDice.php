<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice;

use ArrayIterator;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;
use DiceWar\Domain\Battle\Dice\Value\{AttackDiceValue, DefenseDiceValue, DiceValue};
use IteratorAggregate;

class RoundDice implements IteratorAggregate
{
    /**
     * @var DiceValue[]
     */
    private $diceValues;

    /**
     * RoundDice constructor.
     *
     * @param array $diceValues
     */
    public function __construct(array $diceValues)
    {
        $this->diceValues = $diceValues;
    }

    /**
     * @return int
     */
    public function countInitiationValues(): int
    {
        return (int) array_reduce($this->diceValues, function(int $sum, DiceValue $dice): int {
            return $sum += (int) $dice->isInitial();
        }, 0);
    }

    /**
     * @return int
     */
    public function countAttack(): int
    {
        $attack = 0;

        /** @var DiceValue $diceValue */
        foreach ($this->diceValues as $diceValue) {
            if ($diceValue->isAttack()) {
                /** @var AttackDiceValue $dice */
                $attack += $diceValue->power();
            }
        }

        return $attack;
    }

    /**
     * @return int
     */
    public function countDefense(): int
    {
        $defense = 0;

        /** @var DiceValue $diceValue */
        foreach ($this->diceValues as $diceValue) {
            if ($diceValue->isDefense()) {
                /** @var DefenseDiceValue $dice */
                $defense += $diceValue->defense();
            }
        }

        return $defense;
    }

    /**
     * @return array
     */
    public function getEffects(): array
    {
        $effects = [];

        foreach ($this->diceValues as $diceValue) {
            if (
                $diceValue instanceof EffectDiceValueInterface
                && $diceValue->isEffectOccurred()
                && ($effect = $diceValue->getEffect()) !== null
            ) {
                $effects[] = $effect;
            }
        }

        return $effects;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->diceValues);
    }
}
