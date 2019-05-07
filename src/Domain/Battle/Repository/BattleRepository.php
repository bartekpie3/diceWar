<?php

namespace DiceWar\Domain\Battle\Repository;

use DiceWar\Domain\Battle\Model\Battle;

interface BattleRepository
{
    /**
     * @param Battle $battle
     */
    public function store(Battle $battle);
}
