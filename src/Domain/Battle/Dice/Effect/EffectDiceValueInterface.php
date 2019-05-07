<?php

namespace DiceWar\Domain\Battle\Dice\Effect;

interface EffectDiceValueInterface
{
    public function tryOccurred(): void;

    /**
     * @return bool
     */
    public function isEffectOccurred(): bool;

    /**
     * @return EffectDiceValue|null
     */
    public function getEffect(): ?EffectDiceValue;
}
