<?php

namespace DiceWar\Domain\Battle\ValueObject;

use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    const POSITION_ID = 2;

    /**
     * @var Position
     */
    private $position;

    protected function setUp(): void
    {
        parent::setUp();

        $this->position = new Position(self::POSITION_ID);
    }

    public function testId()
    {
        $this->assertSame(self::POSITION_ID, $this->position->id());
    }

    public function testEquals()
    {
        $this->assertTrue($this->position->equals(new Position(self::POSITION_ID)));
    }
}
