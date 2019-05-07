<?php

namespace DiceWar\Domain\Battle\Dice\Value;

use PHPUnit\Framework\TestCase;

class BlankValueTest extends TestCase
{
    /**
     * @var BlankDiceValue
     */
    private $blankValue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blankValue = new BlankDiceValue;
    }

    public function testIsDefense()
    {
        $this->assertFalse($this->blankValue->isDefense());
    }

    public function testIsAttack()
    {
        $this->assertFalse($this->blankValue->isAttack());
    }
}
