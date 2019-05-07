<?php

namespace DiceWar\Domain\Battle\ValueObject;

use DiceWar\Domain\Battle\Config;
use PHPUnit\Framework\TestCase;

class RoundTest extends TestCase
{
    /**
     * @var Round
     */
    private $round;

    protected function setUp(): void
    {
        parent::setUp();

        $this->round = new Round;
    }

    public function testNextRound()
    {
        $this->assertSame(1, $this->round->value());
        $this->round->nextRound();
        $this->assertSame(2, $this->round->value());
    }

    public function testValue()
    {
        $this->assertSame(1, $this->round->value());
    }

    public function testIsNotExceeded()
    {
        $this->assertTrue($this->round->isNotExceeded());

        for ($i = 0; $i < Config::MAX_BATTLE_ROUNDS; $i++) {
            $this->round->nextRound();
        }

        $this->assertFalse($this->round->isNotExceeded());
    }
}
