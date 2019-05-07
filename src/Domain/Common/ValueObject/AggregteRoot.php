<?php

namespace DiceWar\Domain\Common\ValueObject;

use Ramsey\Uuid\Uuid;

abstract class AggregateRoot
{
    /**
     * @var Uuid
     */
    protected $uuid;

    protected function __construct(Uuid $aggregateRootId)
    {
        $this->uuid = $aggregateRootId;
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    final public function equals(Uuid $uuid)
    {
        return $this->uuid->equals($uuid);
    }

    final protected function raise($event): void
    {
        // EventPublisher::raise($event);
    }

    public function __toString(): string
    {
        return (string) $this->uuid;
    }
}
