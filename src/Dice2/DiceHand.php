<?php
namespace Soln\Dice2;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var DiceHistogram $dices Array consisting of dices.
     * @var Histogram $histogram
     * @var int  $values   Array consisting of last roll of the dices.
     * @var int  $sum      The sum of rolled dices in current game round.
     * @var int  points    The total points in current game.
     */
    private $dices;
    private $histogram;
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
        $this->dices = new DiceHistogram();
        $this->histogram = new Histogram();
        $this->values = [];
        $this->sum = 0;
        $this->points = 0;
        for ($i = 0; $i < $dices; $i++) {
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
        for ($i = 0; $i < sizeof($this->values); $i++) {
            $this->values[$i] = $this->dices->roll();
        }
        $this->histogram->injectData($this->dices);
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

    /**
     * Get the dices
     *
     * @return object the total amount of points in current game
     */
    public function dices()
    {
        return $this->dices;
    }

    /**
     * Get the histogram
     *
     * @return object the total amount of points in current game
     */
    public function histogram()
    {
        return $this->histogram;
    }

    /**
     * Reset the histogram
     *
     * @return object the total amount of points in current game
     */
    public function resetHistogram()
    {
        return $this->histogram->reset();
    }
}
