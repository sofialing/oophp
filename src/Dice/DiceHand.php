<?php
namespace Soln\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices    Array consisting of dices.
     * @var int  $values   Array consisting of last roll of the dices.
     * @var int  $sum      The sum of rolled dices in current game round.
     * @var int  points    The total points in current game.
     */
    private $dices;
    private $values;
    private $sum;
    private $points;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to two.
     */
    public function __construct(int $dices = 2)
    {
        $this->dices  = [];
        $this->values = [];
        $this->sum = 0;
        $this->points = 0;

        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = [];
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        for ($i = 0; $i < sizeof($this->dices); $i++) {
            $this->values[$i] = $this->dices[$i]->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array consisting of values of the last roll.
     */
    public function values()
    {
        return $this->values;
    }

    /**
     * Get the sum of rolled dices.
     *
     * @return int the total points in current game
     */
    public function sum()
    {
        return $this->sum;
    }

    /**
     * Calculate the sum of all rolled dices.
     *
     * @return void
     */
    public function calculateSum()
    {
        if (!in_array(1, $this->values)) {
            $this->sum += array_sum($this->values);
        } else {
            $this->sum = 0;
        }
    }

    /**
     * Reset sum
     *
     * @return void
     */
    public function resetSum()
    {
        $this->sum = 0;
    }

    /**
     * Set points.
     *
     * @return void
     */
    public function setPoints()
    {
        $this->points += $this->sum;
    }

    /**
     * Get points
     *
     * @return int the total amount of points in current game
     */
    public function points()
    {
        return $this->points;
    }
}
