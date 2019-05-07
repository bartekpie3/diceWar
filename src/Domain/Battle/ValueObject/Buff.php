<?php

namespace DiceWar\Domain\Battle\ValueObject;

use InvalidArgumentException;

/**
 * @method int strength
 * @method int agility
 */
class Buff
{
    private const POSSIBLE_BUFFS = [
        'strength',
        'agility'
    ];

    /**
     * @var array
     */
    private $buffs = [];

    /**
     * @param string $attributeName
     * @param int    $buffValue
     */
    public function add(string $attributeName, int $buffValue): void
    {
        if (! $this->isBuffPossible($attributeName)) {
            throw new InvalidArgumentException('Nieobsługiwany buff - ' . $attributeName);
        }

        if (! isset($this->buffs[$attributeName])) {
            $this->buffs[$attributeName] = 0;
        }

        $this->buffs[$attributeName] += $buffValue;
    }

    /**
     * @param string $attributeName
     * @param int    $buffValue
     */
    public function remove(string $attributeName, int $buffValue): void
    {
        if (! isset($this->buffs[$attributeName])) {
            return;
        }

        $this->buffs[$attributeName] -= $buffValue;
    }

    /**
     * @param string $attributeName
     * @param array  $arguments
     *
     * @return int
     */
    public function __call(string $attributeName, array $arguments = []): int
    {
        if (! $this->isBuffPossible($attributeName)) {
            throw new InvalidArgumentException('Nieobsługiwany buff - ' . $attributeName);
        }

        if (isset($this->buffs[$attributeName])) {
            return $this->buffs[$attributeName];
        }

        return 0;
    }

    /**
     * @param string $attributeName
     *
     * @return bool
     */
    private function isBuffPossible(string $attributeName): bool
    {
        if (! in_array($attributeName, self::POSSIBLE_BUFFS)) {
            return false;
        }

        return true;
    }
}
