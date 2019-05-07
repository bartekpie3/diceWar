<?php

declare(strict_types=1);

namespace DiceWar\Domain\Battle\Model;

use DiceWar\Domain\Battle\Dice\DiceCollection;
use DiceWar\Domain\Battle\Dice\Effect\EffectDiceValue;
use DiceWar\Domain\Battle\ValueObject\Buff;
use DiceWar\Domain\Battle\ValueObject\Effect;
use DiceWar\Domain\Battle\ValueObject\Position;
use Ramsey\Uuid\Uuid;

abstract class Fighter
{
    private const FIGHTER_MINIMUM_HP = 0;

    /**
     * @var Uuid
     */
    protected $uuid;

    /**
     * @var int
     */
    protected $currentHp;

    /**
     * @var int
     */
    protected $hp;

    /**
     * @var int
     */
    protected $strength;

    /**
     * @var int
     */
    protected $agility;

    /**
     * @var Position
     */
    protected $position;

    /**
     * @var DiceCollection
     */
    protected $dice;

    /**
     * @var Effect
     */
    private $effect;

    /**
     * @var Buff
     */
    private $buff;

    /**
     * Fighter constructor.
     *
     * @param Uuid           $uuid
     * @param int            $currentHp
     * @param int            $hp
     * @param int            $strength
     * @param int            $agility
     * @param Position       $position
     * @param DiceCollection $dice
     * @param Buff|null      $buff
     */
    public function __construct(
        Uuid $uuid,
        int $currentHp,
        int $hp,
        int $strength,
        int $agility,
        Position $position,
        DiceCollection $dice,
        ?Buff $buff = null
    ) {
        $this->uuid = $uuid;
        $this->currentHp = $currentHp;
        $this->hp = $hp;
        $this->strength = $strength;
        $this->agility = $agility;
        $this->position = $position;
        $this->dice = $dice;
        $this->buff = $buff ?: new Buff;
        $this->effect = new Effect;
    }

    /**
     * @return Uuid
     */
    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    /**
     * @return int
     */
    public function currentHp(): int
    {
        return $this->currentHp;
    }

    /**
     * @return int
     */
    public function hp(): int
    {
        return $this->hp;
    }

    /**
     * @return int
     */
    public function strength(): int
    {
        return $this->strength + $this->buff->strength();
    }

    /**
     * @return int
     */
    public function agility(): int
    {
        return $this->agility + $this->buff->agility();
    }

    /**
     * @return Position
     */
    public function position(): Position
    {
        return $this->position;
    }

    /**
     * @return DiceCollection
     */
    public function dice(): DiceCollection
    {
        return $this->dice;
    }

    /**
     * @return Buff
     */
    public function buff(): Buff
    {
        return $this->buff;
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->currentHp > self::FIGHTER_MINIMUM_HP;
    }

    /**
     * @param int $damage
     *
     * @return Fighter
     */
    public function takeDamage(int $damage): Fighter
    {
        $this->currentHp -= $damage;

        return $this;
    }

    /**
     * @return Fighter
     */
    public function applyEffects(): Fighter
    {
        $this->effect->apply($this);

        return $this;
    }

    /**
     * @param EffectDiceValue $effect
     *
     * @return Fighter
     */
    public function addEffect(EffectDiceValue $effect): Fighter
    {
        $this->effect->add($effect);

        return $this;
    }
}
