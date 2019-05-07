<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice;

class DiceCollection
{
    /**
     * @var Dice[]
     */
    private $dice = [];

    /**
     * DiceCollection constructor.
     *
     * @param Dice[] $dice
     */
    public function __construct(array $dice)
    {
        $this->dice = $dice;
    }

    /**
     * @return RoundDice
     */
    public function roll(): RoundDice
    {
        $diceValues = [];

        /** @var Dice $dice */
        foreach ($this->dice as $dice) {
            $diceValues[] = $dice->roll();
        }

        return new RoundDice($diceValues);
    }
}
