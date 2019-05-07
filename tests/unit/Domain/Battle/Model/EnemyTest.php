<?php

namespace DiceWar\Domain\Battle\Model;

use DiceWar\Domain\Battle\Dice\DiceCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Helper\Fixtures\Battle\EnemyTrait;

class EnemyTest extends TestCase
{
    use EnemyTrait;

    const FIGHTER_HP = 10;
    const FIGHTER_STRENGTH = 1;
    const FIGHTER_AGILITY = 4;

    const ENEMY_TYPE = Enemy::TYPE_MONSTER;

    const FIGHTER_POSITION_ID = 1;

    /**
     * @var Enemy
     */
    private $enemy;

    public function setUp(): void
    {
        parent::setUp();

        $this->enemy = $this->createEnemy();
    }

    public function testHp()
    {
        $this->assertSame(self::FIGHTER_HP, $this->enemy->hp());
    }

    public function testUuid()
    {
        $this->assertInstanceOf(Uuid::class, $this->enemy->uuid());
    }

    public function testPosition()
    {
        $this->assertSame(self::FIGHTER_POSITION_ID, $this->enemy->position()->id());
    }

    public function testCurrentHp()
    {
        $this->assertSame(self::FIGHTER_HP, $this->enemy->currentHp());
    }

    public function testDice()
    {
        $this->assertInstanceOf(DiceCollection::class, $this->enemy->dice());
    }

    public function testTakeDamage()
    {
        $dmg = rand(1, 10);

        $this->assertSame(self::FIGHTER_HP - $dmg, $this->enemy->takeDamage($dmg)->currentHp());
    }

    public function testStrength()
    {
        $this->assertSame(self::FIGHTER_STRENGTH, $this->enemy->strength());
    }

    public function testAgility()
    {
        $this->assertSame(self::FIGHTER_AGILITY, $this->enemy->agility());
    }

    public function testIsAlive()
    {
        $this->assertTrue($this->enemy->isAlive());
    }

    public function testType()
    {
        $this->assertSame(self::ENEMY_TYPE, $this->enemy->type());
    }
}
