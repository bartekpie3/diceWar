<?php

namespace App\Application\Battle\Command;

use DiceWar\Domain\Battle\Exception\PlayerDoesNotHaveEnoughEnergy;
use DiceWar\Domain\Battle\Exception\PlayerIsDead;
use DiceWar\Domain\Battle\Exception\PlayerIsNotInTheSamePositionAsTheEnemy;
use PHPUnit\Framework\TestCase;
use Tests\Helper\Fixtures\Battle\EnemyTrait;
use Tests\Helper\Fixtures\Battle\PlayerTrait;

class StartBattleValidatorTest extends TestCase
{
    use PlayerTrait, EnemyTrait;

    public function testValidateCorrect()
    {
        StartBattleValidator::validate($this->createPlayer(), $this->createEnemy());
    }

    public function testValidatePlayerDoesNotHaveEnergy()
    {
        $this->expectException(PlayerDoesNotHaveEnoughEnergy::class);
        $energy = 0;

        StartBattleValidator::validate($this->createPlayer($energy), $this->createEnemy());
    }

    public function testValidatePlayerIsNotAlive()
    {
        $this->expectException(PlayerIsDead::class);
        $hp = 0;

        StartBattleValidator::validate($this->createPlayer(null, $hp), $this->createEnemy());
    }

    public function testValidatePlayerIsNotInSamePositionAsEnemy()
    {
        $this->expectException(PlayerIsNotInTheSamePositionAsTheEnemy::class);
        $position = 223;

        StartBattleValidator::validate($this->createPlayer(null, null, $position), $this->createEnemy());
    }
}
