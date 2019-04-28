<?php
namespace Soln\Dice;

/**
 * Create and roll dice.
 */
class Dice
{
    /**
     * @var int $number The current dice number.
     * @var int $sides  The number of sides of dice.
     */
    private $number;
    protected $sides;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $sides Number of sides of dices, defaults to six.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Randomize a number between 1 and 6 to roll a dice.
     *
     * @return int as the dice value.
     */
    public function roll()
    {
        $this->number = rand(1, $this->sides);
        return $this->number;
    }

    /**
     * Get value of last rolled dice.
     *
     * @return int as the value of the last rolled dice.
     */
    public function getLastRoll()
    {
        return $this->number;
    }
}
