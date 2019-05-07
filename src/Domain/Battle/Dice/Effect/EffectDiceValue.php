<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Effect;

use DiceWar\Domain\Battle\Model\Fighter;

abstract class EffectDiceValue
{
    const ON_SELF = 'self';
    const ON_ENEMY = 'enemy';

    /**
     * @var int
     */
    private $roundsTakes;

    /**
     * @var int
     */
    private $roundsRemain;

    /**
     * @var bool
     */
    private $isStarted = false;

    /**
     * EffectDiceValue constructor.
     *
     * @param int $roundsTakes
     */
    public function __construct(int $roundsTakes)
    {
        $this->roundsTakes  = $roundsTakes;
        $this->roundsRemain = $roundsTakes;
    }

    /**
     * @param Fighter $fighter
     */
    public function apply(Fighter $fighter): void
    {
        if ($this->isStarted()) {
            $this->call($fighter);
            $this->takeRound();

            return;
        }

        $this->start();
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->roundsRemain === 0;
    }

    public function reset(): void
    {
        $this->roundsRemain = $this->roundsTakes;
    }

    /**
     * @param EffectDiceValue $effect
     *
     * @return bool
     */
    public function equal(EffectDiceValue $effect): bool
    {
        return get_class($effect) === get_class($this);
    }

    /**
     * @return bool
     */
    public function applyOnEnemy(): bool
    {
        return $this->applyOn() === self::ON_ENEMY;
    }

    /**
     * @return bool
     */
    public function applyOnSelf(): bool
    {
        return $this->applyOn() === self::ON_SELF;
    }

    /**
     * @return bool
     */
    private function isStarted(): bool
    {
        return $this->isStarted;
    }

    private function takeRound(): void
    {
        $this->roundsRemain--;
    }

    protected function start(): void
    {
        $this->isStarted = true;
    }

    /**
     * @param Fighter $fighter
     */
    abstract public function call(Fighter $fighter): void;

    /**
     * @return string self::ON_SELF | self::ON_ENEMY
     */
    abstract public function applyOn(): string;
}
