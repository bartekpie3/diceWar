<?php

namespace DiceWar\Domain\Battle\Dice;

use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{
    /**
     * @var Dice
     */
    private $dice;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dice = new Dice([
            new BlankDiceValue()
        ]);
    }

    public function testRoll()
    {
        $this->assertInstanceOf(BlankDiceValue::class, $this->dice->roll());
    }

    public function testCount()
    {
        $this->assertSame(1, $this->dice->count());
    }
}
