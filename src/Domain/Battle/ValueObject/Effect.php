<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\ValueObject;

use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\Model\Fighter;

class Effect
{
    /**
     * @var array
     */
    private $effects = [];

    /**
     * @param EffectDiceValue $effect
     */
    public function add(EffectDiceValue $effect): void
    {
        if (($key = $this->hasAlready($effect)) !== null) {
            $this->effects[$key]->reset();

            return;
        }

        $this->effects[] = $effect;
    }

    /**
     * @param Fighter $fighter
     */
    public function apply(Fighter $fighter): void
    {
        /** @var EffectDiceValue $effect */
        foreach ($this->effects as $key => $effect) {
            $effect->apply($fighter);

            if ($effect->isDone()) {
                $this->remove($key);
            }
        }
    }

    /**
     * @param int $key
     */
    private function remove(int $key): void
    {
        unset($this->effects[$key]);
    }

    /**
     * @param EffectDiceValue $effectToFind
     *
     * @return int|null
     */
    private function hasAlready(EffectDiceValue $effectToFind): ?int
    {
        /** @var EffectDiceValue $effect */
        foreach ($this->effects as $key => $effect) {
            if ($effect->equal($effectToFind)) {
                return $key;
            }
        }

        return null;
    }
}
