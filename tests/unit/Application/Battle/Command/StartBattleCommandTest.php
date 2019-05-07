<?php

namespace App\Application\Battle\Command;

use DiceWar\Domain\Battle\Model\Enemy;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class StartBattleCommandTest extends TestCase
{
    const ENEMY_TYPE = Enemy::TYPE_MONSTER;

    /**
     * @var StartBattleCommand
     */
    private $command;

    protected function setUp(): void
    {
        parent::setUp();

        $this->command = new StartBattleCommand(
            Uuid::uuid4(),
            Uuid::uuid4(),
            Uuid::uuid4(),
            self::ENEMY_TYPE
        );
    }

    public function testGetEnemyId()
    {
        $this->assertInstanceOf(Uuid::class, $this->command->getEnemyId());
    }

    public function testGetEnemyType()
    {
        $this->assertSame(self::ENEMY_TYPE, $this->command->getEnemyType());
    }

    public function testGetBattleId()
    {
        $this->assertInstanceOf(Uuid::class, $this->command->getBattleId());
    }

    public function testGetPlayerId()
    {
        $this->assertInstanceOf(Uuid::class, $this->command->getPlayerId());
    }
}
