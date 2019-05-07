<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice;

use Countable;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;
use DiceWar\Domain\Battle\Dice\Value\DiceValue;

final class Dice implements Countable
{
    /**
     * @var DiceValue[]
     */
    private $values;

    /**
     * Dice constructor.
     *
     * @param DiceValue[] $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @return DiceValue
     */
    public function roll(): DiceValue
    {
        $diceValue = $this->values[mt_rand(0, $this->count() - 1)];

        if ($diceValue instanceof EffectDiceValueInterface) {
            $diceValue->tryOccurred();
        }

        return $diceValue;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->values);
    }
}
