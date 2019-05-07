<?php

namespace DiceWar\Domain\Battle\Log\Event;

use DiceWar\Domain\Battle\Model\Fighter;

class AttackLogEvent extends LogEvent
{
    /**
     * @var Fighter
     */
    private $attacker;

    /**
     * @var Fighter
     */
    private $defender;

    /**
     * @var int
     */
    private $attack;

    /**
     * @var int
     */
    private $defense;

    /**
     * @var int
     */
    private $damage;

    /**
     * AttackLogEvent constructor.
     *
     * @param Fighter $attacker
     * @param Fighter $defender
     * @param int     $attack
     * @param int     $defense
     * @param int     $damage
     */
    public function __construct(Fighter $attacker, Fighter $defender, int $attack, int $defense, int $damage)
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->damage = $damage;
    }

    /**
     * @return Fighter
     */
    public function getAttacker(): Fighter
    {
        return $this->attacker;
    }

    /**
     * @return Fighter
     */
    public function getDefender(): Fighter
    {
        return $this->defender;
    }

    /**
     * @return int
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }
}
