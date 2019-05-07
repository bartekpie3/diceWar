<?php

namespace DiceWar\Domain\Battle\Dice\Effect;

use PHPUnit\Framework\TestCase;
use Tests\Helper\Fixtures\Battle\PlayerTrait;

class EffectWoundDiceValueTest extends TestCase
{
    const DAMAGE = 2;
    const ROUNDS_TAKES = 3;
    const PLAYER_HP = 10;

    use PlayerTrait;

    /**
     * @var EffectWoundDiceValue
     */
    private $effect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->effect = new EffectWoundDiceValue(self::DAMAGE, self::ROUNDS_TAKES);
    }

    public function testApplyOnEnemy()
    {
        $this->assertTrue($this->effect->applyOnEnemy());
    }

    public function testSingleApply()
    {
        $player = $this->createPlayer(null, self::PLAYER_HP);

        $this->effect->apply($player);
        $this->effect->apply($player);

        $this->assertSame(self::PLAYER_HP - self::DAMAGE, $player->currentHp());
    }

    public function testApplyUntilDone()
    {
        $player = $this->createPlayer(null, self::PLAYER_HP);

        while (! $this->effect->isDone()) {
            $this->effect->apply($player);
        }

        $this->assertSame(self::PLAYER_HP - self::DAMAGE * self::ROUNDS_TAKES, $player->currentHp());
    }

    public function testIsDone()
    {
        $this->assertFalse($this->effect->isDone());

        $player = $this->createPlayer();

        for ($i = 0; $i <= self::ROUNDS_TAKES; $i++) {
            $this->effect->apply($player);
        }

        $this->assertTrue($this->effect->isDone());
    }

    public function testApplyOn()
    {
        $this->assertSame(EffectDiceValue::ON_ENEMY, $this->effect->applyOn());
    }

    public function testReset()
    {
        $this->testIsDone();

        $this->effect->reset();

        $this->assertFalse($this->effect->isDone());
    }

    public function testApplyOnSelf()
    {
        $this->assertfalse($this->effect->applyOnSelf());
    }

    public function testEqualCorrect()
    {
        $sameEffect = new EffectWoundDiceValue(3, 2);

        $this->assertTrue($this->effect->equal($sameEffect));
    }

    public function testEqualWrong()
    {
        $differentEffect = $this->createMock(EffectDiceValue::class);;

        $this->assertFalse($this->effect->equal($differentEffect));
    }
}
