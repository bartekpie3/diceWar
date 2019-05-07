<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use PHPUnit\Framework\TestCase;

class CriticAttackDiceValueTest extends TestCase
{
    const POWER = 4;
    const CRITIC_CHANCE = 100;

    /**
     * @var CriticAttackDiceValue
     */
    private $diceValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->diceValue = new CriticAttackDiceValue(self::POWER, self::CRITIC_CHANCE, true);
    }

    public function testIsInitial()
    {
        $this->assertTrue($this->diceValue->isInitial());
    }

    public function testGetEffect()
    {
        $this->assertNull($this->diceValue->getEffect());
    }

    public function testIsDefense()
    {
        $this->assertFalse($this->diceValue->isDefense());
    }

    public function testIsEffectOccurred()
    {
        $this->assertFalse($this->diceValue->isEffectOccurred());

        $this->diceValue->tryOccurred();

        $this->assertTrue($this->diceValue->isEffectOccurred());
    }

    public function testIsAttack()
    {
        $this->assertTrue($this->diceValue->isAttack());
    }

    public function testPower()
    {
        $this->assertSame(self::POWER, $this->diceValue->power());
    }

    public function testPowerWithCriticDamage()
    {
        $this->diceValue->tryOccurred();

        $this->assertSame(self::POWER + self::POWER / 2, $this->diceValue->power());
    }
}
