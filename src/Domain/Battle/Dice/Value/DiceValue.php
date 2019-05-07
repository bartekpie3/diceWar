<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Dice\Value;

abstract class DiceValue
{
    /**
     * @var bool
     */
    private $isInitial;

    /**
     * DiceValue constructor.
     *
     * @param bool $isInitial
     */
    public function __construct(bool $isInitial)
    {
        $this->isInitial = $isInitial;
    }

    /**
     * @return bool
     */
    public function isInitial(): bool
    {
        return $this->isInitial;
    }

    /**
     * @return bool
     */
    abstract public function isAttack(): bool;

    /**
     * @return bool
     */
    abstract public function isDefense(): bool;
}
