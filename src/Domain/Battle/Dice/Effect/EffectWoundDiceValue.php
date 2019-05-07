<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Effect;

use DiceWar\Domain\Battle\Model\Fighter;

class EffectWoundDiceValue extends EffectDiceValue
{
    /**
     * @var int
     */
    private $damage;

    /**
     * EffectWoundDiceValue constructor.
     *
     * @param int $damage
     * @param int $roundsTakes
     */
    public function __construct(int $damage, int $roundsTakes)
    {
        parent::__construct($roundsTakes);

        $this->damage = $damage;
    }

    /**
     * {@inheritDoc}
     */
    public function call(Fighter $fighter): void
    {
        $fighter->takeDamage($this->damage);
    }

    /**
     * {@inheritDoc}
     */
    public function applyOn(): string
    {
        return self::ON_ENEMY;
    }
}
