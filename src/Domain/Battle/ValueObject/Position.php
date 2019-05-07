<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\ValueObject;

class Position
{
    /**
     * @var int
     */
    private $id;

    /**
     * Position constructor.
     *
     * @param $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param Position $position
     *
     * @return bool
     */
    public function equals(Position $position): bool
    {
        return $position->id() === $this->id;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }
}
