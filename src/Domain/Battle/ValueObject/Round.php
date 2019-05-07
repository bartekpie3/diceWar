<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\ValueObject;

use DiceWar\Domain\Battle\Config;

class Round
{
    /**
     * @var int
     */
    private $value = 1;

    public function nextRound(): void
    {
        $this->value++;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isNotExceeded(): bool
    {
        return $this->value < Config::MAX_BATTLE_ROUNDS;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}
