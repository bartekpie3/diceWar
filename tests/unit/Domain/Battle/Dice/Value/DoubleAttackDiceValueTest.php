<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use PHPUnit\Framework\TestCase;

class DoubleAttackDiceValueTest extends TestCase
{
    const POWER = 4;
    const DOUBLE_CHANCE = 100;

    /**
     * @var DoubleAttackDiceValue
     */
    private $diceValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->diceValue = new DoubleAttackDiceValue(self::POWER, self::DOUBLE_CHANCE, false);
    }

    public function testGetEffect()
    {
        $this->assertNull($this->diceValue->getEffect());
    }

    public function testIsDefense()
    {
        $this->assertFalse($this->diceValue->isDefense());
    }

    public function testIsAttack()
    {
        $this->assertTrue($this->diceValue->isAttack());
    }

    public function testPower()
    {
        $this->assertSame(self::POWER, $this->diceValue->power());
    }

    public function testPowerWithDoubleDamage()
    {
        $this->diceValue->tryOccurred();

        $this->assertSame(self::POWER * 2, $this->diceValue->power());
    }

    public function testIsEffectOccurred()
    {
        $this->assertFalse($this->diceValue->isEffectOccurred());

        $this->diceValue->tryOccurred();

        $this->assertTrue($this->diceValue->isEffectOccurred());
    }
}
