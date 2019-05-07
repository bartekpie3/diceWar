<?php

namespace DiceWar\Domain\Battle\Model;

use DiceWar\Domain\Battle\Log\Log;
use DiceWar\Domain\Battle\ValueObject\Round;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Helper\Fixtures\Battle\EnemyTrait;
use Tests\Helper\Fixtures\Battle\PlayerTrait;

class BattleTest extends TestCase
{
    use EnemyTrait, PlayerTrait;

    /**
     * @var Battle
     */
    private $battle;

    protected function setUp(): void
    {
        parent::setUp();

        $this->battle = new Battle(
            Uuid::uuid4(),
            $this->createPlayer(),
            $this->createEnemy(),
            new Log,
            new \DateTime,
            new Round
        );
    }

    public function testStartBattle()
    {
        $this->assertInstanceOf(Battle::class, Battle::startBattle(
            Uuid::uuid4(),
            $this->createPlayer(),
            $this->createEnemy()
        ));
    }

    public function testIsNotExceeded()
    {
        $this->assertTrue($this->battle->isNotExceeded());
    }

    public function testEnemy()
    {
        $this->assertInstanceOf(Enemy::class, $this->battle->enemy());
    }

    public function testNextRound()
    {
        $this->assertSame(1, $this->battle->round());
        $this->battle->nextRound();
        $this->assertSame(2, $this->battle->round());
    }

    public function testRound()
    {
        $this->assertSame(1, $this->battle->round());
    }

    public function testPlayer()
    {
        $this->assertInstanceOf(Player::class, $this->battle->player());
    }
}
