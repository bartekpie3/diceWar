<?php

namespace DiceWar\Domain\Battle\Dice\Effect;

use DiceWar\Domain\Battle\Model\Fighter;

class EffectBuffStrengthDiceValue extends EffectDiceValue
{
    /**
     * @var int
     */
    private $strengthBuff;

    /**
     * @var bool
     */
    private $wasApply = false;

    /**
     * EffectBuffStrengthDiceValue constructor.
     *
     * @param int $strengthBuff
     * @param int $roundTakes
     */
    public function __construct(int $strengthBuff, int $roundTakes)
    {
        parent::__construct($roundTakes);

        $this->strengthBuff = $strengthBuff;
        $this->start();
    }

    /**
     * {@inheritDoc}
     */
    public function call(Fighter $fighter): void
    {
        if ($this->isDone()) {
            $fighter->buff()->remove('strength', $this->strengthBuff);
            $this->wasApply = false;
        } elseif (! $this->wasApply) {
            $fighter->buff()->add('strength', $this->strengthBuff);
            $this->wasApply = true;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function applyOn(): string
    {
        return self::ON_SELF;
    }
}
