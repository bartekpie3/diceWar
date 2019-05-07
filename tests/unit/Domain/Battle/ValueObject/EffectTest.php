<?php

namespace DiceWar\Domain\Battle\ValueObject;

use DiceWar\Domain\Battle\Dice\Effect\EffectWoundDiceValue;
use PHPUnit\Framework\TestCase;
use Tests\Helper\Fixtures\Battle\PlayerTrait;

class EffectTest extends TestCase
{
    use PlayerTrait;

    const DAMAGE = 2;
    const ROUNDS_TAKES = 3;
    const PLAYER_HP = 20;

    /**
     * @var Effect
     */
    private $effect;

    protected function setUp(): void
    {
        parent::setUp();

        $this->effect = new Effect;
    }

    public function testApply()
    {
        $player = $this->createPlayer(null, self::PLAYER_HP);

        $this->add();

        for ($i = -1; $i <= self::ROUNDS_TAKES; $i++) {
            $this->effect->apply($player);
        }

        $this->assertSame(self::PLAYER_HP - self::DAMAGE * self::ROUNDS_TAKES, $player->currentHp());
    }

    public function testApplyWithAddExistEffect()
    {
        $player = $this->createPlayer(null, self::PLAYER_HP);

        $this->add();

        for ($i = 0; $i <= 10; $i++) {
            if ($i === 3) {
                $this->add();
            }

            $this->effect->apply($player);
        }

        $this->assertSame(self::PLAYER_HP - self::DAMAGE * (self::ROUNDS_TAKES + 2), $player->currentHp());
    }

    private function add()
    {
        $effect = new EffectWoundDiceValue(self::DAMAGE, self::ROUNDS_TAKES);

        $this->effect->add($effect);
    }
}
