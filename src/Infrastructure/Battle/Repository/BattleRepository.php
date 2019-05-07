<?php

namespace App\Infrastructure\Battle\Repository;

use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValueInterface;
use DiceWar\Domain\Battle\Dice\Value\BlankDiceValue;
use DiceWar\Domain\Battle\Dice\Value\DiceValue;
use DiceWar\Domain\Battle\Log\Event\AttackLogEvent;
use DiceWar\Domain\Battle\Log\Event\BattleEndLogEvent;
use DiceWar\Domain\Battle\Log\Event\RollDiceLogEvent;
use DiceWar\Domain\Battle\Log\Event\StartRoundLogEvent;
use DiceWar\Domain\Battle\Model\Battle;
use DiceWar\Domain\Battle\Model\Player;

class BattleRepository implements \DiceWar\Domain\Battle\Repository\BattleRepository
{
    /**
     * @param Battle $battle
     */
    public function store(Battle $battle)
    {
        foreach ($battle->logs() as $log) {
            switch (get_class($log)) {
                case StartRoundLogEvent::class:
                    /** @var StartRoundLogEvent $log */
                    echo '---------------------------------------------------------------------------------' . PHP_EOL;
                    echo 'START RUNDY - ' . $log->getRoundNumber() . PHP_EOL;

                    $player = $log->getPlayer();
                    $enemy = $log->getEnemy();

                    printf('PLAYER >> hp %d | strength %d | agillity %d' . PHP_EOL, $player->currentHp(), $player->strength(), $player->agility());
                    printf('ENEMY >> hp %d | strength %d | agillity %d' . PHP_EOL, $enemy->currentHp(), $enemy->strength(), $enemy->agility());

                    break;

                case RollDiceLogEvent::class:
                    /** @var RollDiceLogEvent $log */
                    echo 'ROLL' . PHP_EOL;
                    echo '--- Player --- ' . PHP_EOL;

                    /** @var DiceValue $diceValue */
                    foreach ($log->getPlayerDice() as $diceValue) {
                        $isSpecial = $diceValue instanceof EffectDiceValueInterface && $diceValue->isEffectOccurred();

                        echo ($diceValue->isInitial() ? '(I) ' : '');
                        echo (($diceValue instanceof BlankDiceValue) ? 'Blank' :
                            ((!$diceValue->isAttack() && !$diceValue->isDefense()) ? get_class($diceValue) :
                            ($diceValue->isAttack()
                            ? ($isSpecial ? '[S] ' : '') . 'Attack - ' . $diceValue->power()
                            : 'Defense - ' . $diceValue->defense()
                            ))
                        );
                        echo PHP_EOL;
                    }

                    echo '--- Enemy ---' . PHP_EOL;

                    /** @var DiceValue $diceValue */
                    foreach ($log->getEnemyDice() as $diceValue) {
                        $isSpecial = $diceValue instanceof EffectDiceValueInterface && $diceValue->isEffectOccurred();

                        echo ($diceValue->isInitial() ? '(I) ' : '');
                        echo (($diceValue instanceof BlankDiceValue) ? 'Blank' : ($diceValue->isAttack()
                            ? ($isSpecial ? '[S] ' : '') . 'Attack - ' . $diceValue->power()
                            : 'Defense - ' . $diceValue->defense()
                        )
                        );
                        echo PHP_EOL;
                    }

                    break;

                case AttackLogEvent::class:
                    /** @var AttackLogEvent $log */
                    echo 'ATTACK - ' . ($log->getAttacker() instanceof Player ? 'Player x Enemy' : 'Enemy x Player') .
                    ' >> attack ' . $log->getAttack() . ' defense ' . $log->getDefense() . ($log->getDamage() > 0 ?
                            ' obrazenia zadane ' . $log->getDamage() : ' obrażenia zniwelowane');
                    break;

                case BattleEndLogEvent::class:
                    /** @var BattleEndLogEvent $log */
                    echo '---------------------------------------------------------------------------------' . PHP_EOL;
                    echo $log->isDraw() ? 'REMIS' : $log->getWinner() instanceof Player ? 'Wygrał - Player' : 'Wygrał - Enemy';
                    break;
            }

            echo PHP_EOL;
        }
    }
}
