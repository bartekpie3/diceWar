<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use DiceWar\Domain\Battle\Dice\Effect\EffectWoundDiceValue;
use PHPUnit\Framework\TestCase;

class WoundAttackDiceValueTest extends TestCase
{
    const POWER = 2;
    const WOUND_DAMAGE = 1;
    const WOUND_ROUNDS = 4;

    /**
     * @var WoundAttackDiceValue
     */
    private $diceValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->diceValue = new WoundAttackDiceValue(
            self::POWER,
            self::WOUND_DAMAGE,
            self::WOUND_ROUNDS,
            false
        );
    }

    public function testIsInitial()
    {
        $this->assertFalse($this->diceValue->isInitial());
    }

    public function testIsDefense()
    {
        $this->assertFalse($this->diceValue->isDefense());
    }

    public function testGetEffect()
    {
        $this->assertInstanceOf(EffectWoundDiceValue::class, $this->diceValue->getEffect());
    }

    public function testPower()
    {
        $this->assertSame(self::POWER, $this->diceValue->power());
    }

    public function testIsAttack()
    {
        $this->assertTrue($this->diceValue->isAttack());
    }

    public function testIsEffectOccurred()
    {
        $this->assertTrue($this->diceValue->isEffectOccurred());
    }
}
