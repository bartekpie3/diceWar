<?php

namespace DiceWar\Domain\Battle\Dice;

use DiceWar\Domain\Battle\Dice\Value\AttackDiceValue;
use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use DiceWar\Domain\Battle\Dice\Value\DefenseDiceValue;
use DiceWar\Domain\Battle\Dice\Value\WoundAttackDiceValue;
use PHPUnit\Framework\TestCase;

class RoundDiceTest extends TestCase
{
    /**
     * @var RoundDice
     */
    private $roundDice;

    protected function setUp(): void
    {
        parent::setUp();

        $this->roundDice = new RoundDice([
            new BlankDiceValue,
            new AttackDiceValue(2, true),
            new AttackDiceValue(4, false),
            new DefenseDiceValue(3, true),
            new WoundAttackDiceValue(0, 2, 3, false)
        ]);
    }

    public function testCountInitiationValues()
    {
        $this->assertSame(2, $this->roundDice->countInitiationValues());
    }

    public function testCountAttack()
    {
        $this->assertSame(6, $this->roundDice->countAttack());
    }

    public function testCountDefense()
    {
        $this->assertSame(3, $this->roundDice->countDefense());
    }

    public function testGetEffects()
    {
        $effects = $this->roundDice->getEffects();

        //$this->assertIsArray($effects);
        $this->assertCount(1, $effects);
    }
}
