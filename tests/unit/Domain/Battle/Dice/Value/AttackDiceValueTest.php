<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use PHPUnit\Framework\TestCase;

class AttackDiceValueTest extends TestCase
{
    const POWER = 6;
    const IS_INITIAL = true;

    /**
     * @var AttackDiceValue
     */
    private $commonAttackValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commonAttackValue = new AttackDiceValue(self::POWER, self::IS_INITIAL);
    }

    public function testPower()
    {
        $this->assertSame(self::POWER, $this->commonAttackValue->power());
    }

    public function testIsInitial()
    {
        $this->assertSame(self::IS_INITIAL, $this->commonAttackValue->isInitial());
    }

    public function testIsAttack()
    {
        $this->assertTrue($this->commonAttackValue->isAttack());
    }

    public function testIsDefense()
    {
        $this->assertFalse($this->commonAttackValue->isDefense());
    }
}
