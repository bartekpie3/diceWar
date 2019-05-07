<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Log;

use DiceWar\Domain\Battle\Log\Event\LogEvent;

final class Log
{
    /**
     * @var LogEvent[]
     */
    private $logs;

    /**
     * @param LogEvent $event
     *
     * @return Log
     */
    public function record(LogEvent $event): Log
    {
        $this->logs[] = $event;

        return $this;
    }

    /**
     * @return LogEvent[]
     */
    public function logs(): array
    {
        return $this->logs;
    }
}
