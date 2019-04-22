<?php

namespace Soln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $diceHand = new \Soln\Dice\DiceHand();
        $this->assertInstanceOf("\Soln\Dice\DiceHand", $diceHand);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use arguments.
     */
    public function testCreateObjectWithArguments()
    {
        $dices = 3;
        $diceHand = new \Soln\Dice\DiceHand($dices);
        $this->assertInstanceOf("\Soln\Dice\DiceHand", $diceHand);

        $this->assertEquals($dices, sizeof($diceHand->values()));
    }

    /**
     * Construct object and tests method 'roll'
     */
    public function testRollDice()
    {
        $diceHand = new \Soln\Dice\DiceHand(2);
        $diceHand->roll();

        $this->assertEquals(2, sizeof($diceHand->values()));
    }

    /**
     *  Construct object and tests method 'resetSum'
     */
    public function testResetSum()
    {
        $diceHand = new \Soln\Dice\DiceHand();

        $diceHand->roll();
        $diceHand->calculateSum();
        $diceHand->resetSum();

        $res = $diceHand->sum();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
