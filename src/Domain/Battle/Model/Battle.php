<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Model;

use DateTime;
use DiceWar\Domain\Battle\Event\BattleWasStarted;
use DiceWar\Domain\Battle\Log\Log;
use DiceWar\Domain\Battle\Log\Event\LogEvent;
use DiceWar\Domain\Battle\ValueObject\Round;
use DiceWar\Domain\Common\ValueObject\AggregateRoot;
use Exception;
use Ramsey\Uuid\Uuid;

final class Battle extends AggregateRoot
{
    /**
     * @var Player
     */
    private $player;

    /**
     * @var Enemy
     */
    private $enemy;

    /**
     * @var Log
     */
    private $log;

    /**
     * @var Round
     */
    private $round;

    /**
     * @var DateTime
     */
    private $started;

    /**
     * Battle constructor.
     *
     * @param Uuid     $battleId
     * @param Player   $player
     * @param Enemy    $enemy
     * @param Log      $log
     * @param DateTime $started
     * @param Round    $round
     */
    public function __construct(
        Uuid $battleId,
        Player $player,
        Enemy $enemy,
        Log $log,
        DateTime $started,
        Round $round
    ) {
        parent::__construct($battleId);

        $this->player = $player;
        $this->enemy = $enemy;
        $this->started = $started;
        $this->log = $log;
        $this->round = $round;
    }

    /**
     * @param Uuid   $battleId
     * @param Player $player
     * @param Enemy  $enemy
     *
     * @return Battle
     *
     * @throws Exception
     */
    public static function startBattle(Uuid $battleId, Player $player, Enemy $enemy): Battle
    {
        $battle = new self($battleId, $player, $enemy, new Log, new DateTime, new Round);

        $battle->raise(
            new BattleWasStarted($battleId, $player, $enemy)
        );

        return $battle;
    }

    /**
     * @return $this
     */
    public function nextRound(): Battle
    {
        $this->round->nextRound();

        return $this;
    }

    /**
     * @param LogEvent $event
     *
     * @return $this
     */
    public function record(LogEvent $event): Battle
    {
        $this->log->record($event);

        return $this;
    }

    /**
     * @return bool
     */
    public function isNotExceeded(): bool
    {
        return $this->round->isNotExceeded();
    }

    /**
     * @return Player
     */
    public function player(): Player
    {
        return clone $this->player;
    }

    /**
     * @return Enemy
     */
    public function enemy(): Enemy
    {
        return clone $this->enemy;
    }

    /**
     * @return int
     */
    public function round(): int
    {
        return $this->round->value();
    }

    /**
     * @return array
     */
    public function logs(): array
    {
        return $this->log->logs();
    }
}
