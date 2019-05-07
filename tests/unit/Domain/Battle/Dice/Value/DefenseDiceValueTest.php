<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use PHPUnit\Framework\TestCase;

class DefenseDiceValueTest extends TestCase
{
    const DEFENSE = 3;
    const IS_INITIAL = false;

    /**
     * @var DefenseDiceValue
     */
    private $commonDefenseValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commonDefenseValue = new DefenseDiceValue(self::DEFENSE, self::IS_INITIAL);
    }

    public function testIsInitial()
    {
        $this->assertSame(self::IS_INITIAL, $this->commonDefenseValue->isInitial());
    }

    public function testIsDefense()
    {
        $this->assertTrue($this->commonDefenseValue->isDefense());
    }

    public function testIsAttack()
    {
        $this->assertFalse($this->commonDefenseValue->isAttack());
    }

    public function testDefense()
    {
        $this->assertSame(self::DEFENSE, $this->commonDefenseValue->defense());
    }
}
