<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use DiceWar\Domain\Battle\Dice\Effect\EffectBuffStrengthDiceValue;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;

class StrengthBuffDiceValue extends DiceValue implements EffectDiceValueInterface
{
    /**
     * @var int
     */
    private $strengthBuff;

    /**
     * @var int
     */
    private $buffRoundsTakes;

    /**
     * StrengthBuffDiceValue constructor.
     *
     * @param int  $strengthBuff
     * @param int  $buffRoundsTakes
     * @param bool $isInitial
     */
    public function __construct(int $strengthBuff, int $buffRoundsTakes, bool $isInitial)
    {
        parent::__construct($isInitial);

        $this->strengthBuff = $strengthBuff;
        $this->buffRoundsTakes = $buffRoundsTakes;
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
        return false;
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
        return new EffectBuffStrengthDiceValue($this->strengthBuff, $this->buffRoundsTakes);
    }
}
