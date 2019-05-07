<?php

namespace App\Application\Battle\Command;

use DiceWar\Domain\Battle\Config;
use DiceWar\Domain\Battle\Exception\{PlayerDoesNotHaveEnoughEnergy, PlayerIsDead, PlayerIsNotInTheSamePositionAsTheEnemy};
use DiceWar\Domain\Battle\Model\{Enemy, Player};

final class StartBattleValidator
{
    /**
     * @param Player $player
     * @param Enemy  $enemy
     *
     * @throws PlayerDoesNotHaveEnoughEnergy
     * @throws PlayerIsNotInTheSamePositionAsTheEnemy
     * @throws PlayerIsDead
     */
    public static function validate(Player $player, Enemy $enemy): void
    {
        if ($player->energy() < Config::MINIMUM_ENERGY_REQUIRED_TO_START_BATTLE) {
            throw new PlayerDoesNotHaveEnoughEnergy;
        }

        if (! $player->position()->equals($enemy->position())) {
            throw new PlayerIsNotInTheSamePositionAsTheEnemy;
        }

        if (! $player->isAlive()) {
            throw new PlayerIsDead;
        }
    }
}
