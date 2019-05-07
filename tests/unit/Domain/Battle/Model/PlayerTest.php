<?php

namespace DiceWar\Domain\Battle\Model;

use DiceWar\Domain\Battle\Dice\DiceCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Helper\Fixtures\Battle\PlayerTrait;

class PlayerTest extends TestCase
{
    use PlayerTrait;

    const FIGHTER_HP = 20;
    const FIGHTER_STRENGTH = 3;
    const FIGHTER_AGILITY = 2;
    const FIGHTER_ENERGY = 10;

    const FIGHTER_POSITION_ID = 1;

    /**
     * @var Player
     */
    private $player;

    public function setUp(): void
    {
        parent::setUp();

        $this->player = $this->createPlayer();
    }

    public function testHp()
    {
        $this->assertSame(self::FIGHTER_HP, $this->player->hp());
    }

    public function testUuid()
    {
        $this->assertInstanceOf(Uuid::class, $this->player->uuid());
    }

    public function testPosition()
    {
        $this->assertSame(self::FIGHTER_POSITION_ID, $this->player->position()->id());
    }

    public function testEnergy()
    {
        $this->assertSame(self::FIGHTER_ENERGY, $this->player->energy());
    }

    public function testCurrentHp()
    {
        $this->assertSame(self::FIGHTER_HP, $this->player->currentHp());
    }

    public function testDice()
    {
        $this->assertInstanceOf(DiceCollection::class, $this->player->dice());
    }

    public function testTakeDamage()
    {
        $dmg = rand(1, 10);

        $this->assertSame(self::FIGHTER_HP - $dmg, $this->player->takeDamage($dmg)->currentHp());
    }

    public function testStrength()
    {
        $this->assertSame(self::FIGHTER_STRENGTH, $this->player->strength());
    }

    public function testAgility()
    {
        $this->assertSame(self::FIGHTER_AGILITY, $this->player->agility());
    }

    public function testIsAlive()
    {
        $this->assertTrue($this->player->isAlive());
    }
}
