<?php

namespace App\Application\Battle\Command;

use DiceWar\Domain\Battle\Exception\{
    EnemyNotExist,
    PlayerDoesNotHaveEnoughEnergy,
    PlayerIsDead,
    PlayerIsNotInTheSamePositionAsTheEnemy,
    PlayerNotExist
};
use DiceWar\Domain\Battle\Factory\EnemyFactory;
use DiceWar\Domain\Battle\Model\Battle;
use DiceWar\Domain\Battle\Repository\{BattleRepository, PlayerRepository};
use DiceWar\Domain\Battle\Service\FightService;

final class StartBattleHandler
{
    /**
     * @var PlayerRepository
     */
    private $playerRepository;

    /**
     * @var EnemyFactory
     */
    private $enemyFactory;

    /**
     * @var BattleRepository
     */
    private $battleRepository;

    /**
     * StartBattleHandler constructor.
     *
     * @param PlayerRepository $playerRepository
     * @param EnemyFactory     $enemyFactory
     * @param BattleRepository $battleRepository
     */
    public function __construct(
        PlayerRepository $playerRepository,
        EnemyFactory $enemyFactory,
        BattleRepository $battleRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->enemyFactory = $enemyFactory;
        $this->battleRepository = $battleRepository;
    }

    /**
     * @param StartBattleCommand $command
     *
     * @throws PlayerDoesNotHaveEnoughEnergy
     * @throws PlayerIsDead
     * @throws PlayerIsNotInTheSamePositionAsTheEnemy
     * @throws EnemyNotExist
     * @throws PlayerNotExist
     */
    public function handle(StartBattleCommand $command): void
    {
        $player = $this->playerRepository->getPlayer($command->getPlayerId());
        $enemy = $this->enemyFactory->pickEnemy($command->getEnemyId(), $command->getEnemyType());

        StartBattleValidator::validate($player, $enemy);

        $battle = Battle::startBattle($command->getBattleId(), $player, $enemy);

        (new FightService($battle))->fight();

        $this->battleRepository->store($battle);
    }
}
