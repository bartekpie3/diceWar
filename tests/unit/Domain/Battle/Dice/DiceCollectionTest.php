<?php

namespace DiceWar\Domain\Battle\Dice;

use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use PHPUnit\Framework\TestCase;

class DiceCollectionTest extends TestCase
{
    /**
     * @var DiceCollection
     */
    private $diceCollection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->diceCollection = new DiceCollection([
            new Dice([
                new BlankDiceValue
            ])
        ]);
    }

    public function testRoll()
    {
        $this->assertInstanceOf(RoundDice::class, $this->diceCollection->roll());
    }
}
