<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Service;

use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\Model\{Battle, Enemy, Fighter, Player};
use DiceWar\Domain\Battle\Dice\RoundDice;
use DiceWar\Domain\Battle\Log\Event\{AttackLogEvent, BattleEndLogEvent, RollDiceLogEvent, StartRoundLogEvent};

class FightService
{
    /**
     * @var Battle
     */
    private $battle;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var Enemy
     */
    private $enemy;

    /**
     * FightService constructor.
     *
     * @param Battle $battle
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
        $this->enemy  = $battle->enemy();
        $this->player = $battle->player();
    }

    /**
     * Fight
     */
    public function fight(): void
    {
        while ($this->bothFightersAreAlive() && $this->battle->isNotExceeded()) {
            $this->battle->record(new StartRoundLogEvent($this->battle->round(), clone $this->player, clone $this->enemy));

            $playerDice = $this->player->dice()->roll();
            $enemyDice  = $this->enemy->dice()->roll();

            $this->battle->record(new RollDiceLogEvent($playerDice, $enemyDice));

            $this->applyEffects($playerDice->getEffects(), $enemyDice->getEffects());

            if (! $this->bothFightersAreAlive()) {
                break;
            }

            [$attacker, $attackerDice, $defender, $defenderDice] = $this->selectAttackerDefender($playerDice, $enemyDice);

            $this->attack($attacker, $attackerDice, $defender, $defenderDice);

            if (! $defender->isAlive()) {
                break;
            }

            $this->attack($defender, $defenderDice, $attacker, $attackerDice);

            $this->battle->nextRound();
        }

        $this->battle->record(new BattleEndLogEvent($this->showWinner()));
    }

    /**
     * @param Fighter   $attacker
     * @param RoundDice $attackerDice
     * @param Fighter   $defender
     * @param RoundDice $defenderDice
     */
    private function attack(Fighter $attacker, RoundDice $attackerDice, Fighter $defender, RoundDice $defenderDice): void
    {
        $attack  = $attackerDice->countAttack() + $attacker->strength();
        $defense = $defenderDice->countDefense() + $defender->agility();

        $damage = $attack - $defense;

        if ($damage > 0) {
            $defender->takeDamage($damage);
        }

        $this->battle->record(new AttackLogEvent($attacker, $defender, $attack, $defense, $damage));
    }

    /**
     * @return bool
     */
    private function bothFightersAreAlive(): bool
    {
        return $this->player->isAlive() && $this->enemy->isAlive();
    }

    /**
     * @param RoundDice $playerDice
     * @param RoundDice $enemyDice
     *
     * @return array
     */
    private function selectAttackerDefender(RoundDice $playerDice, RoundDice $enemyDice): array
    {
        if ($playerDice->countInitiationValues() >= $enemyDice->countInitiationValues()) {
            return [$this->player, $playerDice, $this->enemy, $enemyDice];
        }

        return [$this->enemy, $enemyDice, $this->player, $playerDice];
    }

    /**
     * @return Fighter|null
     */
    private function showWinner(): ?Fighter
    {
        if (! $this->player->isAlive()) {
            return $this->enemy;
        } elseif (! $this->enemy->isAlive()) {
            return $this->player;
        }

        return null;
    }

    /**
     * @param array $playerEffects
     * @param array $enemyEffects
     */
    private function applyEffects(array $playerEffects, array $enemyEffects): void
    {
        $apply = function(array $effects, Fighter $self, Fighter $enemy): void {
            /** @var EffectDiceValue $effect */
            foreach ($effects as $effect) {
                if ($effect->applyOnSelf()) {
                    $self->addEffect($effect);
                } else {
                    $enemy->addEffect($effect);
                }
            }
        };

        $apply($playerEffects, $this->player, $this->enemy);
        $apply($enemyEffects, $this->enemy, $this->player);

        $this->player->applyEffects();
        $this->enemy->applyEffects();
    }
}
