<?php

namespace DiceWar\Domain\Battle\Repository;

use DiceWar\Domain\Battle\Exception\PlayerNotExist;
use DiceWar\Domain\Battle\Model\Player;
use Ramsey\Uuid\Uuid;

interface PlayerRepository
{
    /**
     * @param Uuid $playerId
     *
     * @return Player
     *
     * @throws PlayerNotExist
     */
    public function getPlayer(Uuid $playerId): Player;
}
