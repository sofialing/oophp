<?php

namespace Soln\Dice2;

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
        $diceHand = new \Soln\Dice2\DiceHand();
        $this->assertInstanceOf("\Soln\Dice2\DiceHand", $diceHand);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use arguments.
     */
    public function testCreateObjectWithArguments()
    {
        $dices = 3;
        $diceHand = new \Soln\Dice2\DiceHand($dices);
        $this->assertInstanceOf("\Soln\Dice2\DiceHand", $diceHand);

        $this->assertEquals($dices, sizeof($diceHand->values()));
    }

    /**
     * Construct object and tests method 'roll'
     */
    public function testRollDice()
    {
        $diceHand = new \Soln\Dice2\DiceHand(2);
        $diceHand->roll();

        $this->assertEquals(2, sizeof($diceHand->values()));
    }

    /**
     *  Construct object and tests method 'resetSum'
     */
    public function testResetSum()
    {
        $diceHand = new \Soln\Dice2\DiceHand();

        $diceHand->roll();
        $diceHand->calculateSum();
        $diceHand->resetSum();

        $res = $diceHand->sum();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     *  Construct object and tests method 'histogram'
     */
    public function testHistogram()
    {
        $diceHand = new \Soln\Dice2\DiceHand();

        $diceHand->roll();

        $res = count($diceHand->histogram()->getSerie());
        $exp = 2;
        $this->assertEquals($exp, $res);
    }

    /**
     *  Construct object and tests method 'resetHistogram'
     */
    public function testResetHistogram()
    {
        $diceHand = new \Soln\Dice2\DiceHand();

        $diceHand->roll();
        $diceHand->resetHistogram();

        $res = count($diceHand->histogram()->getSerie());
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     *  Construct object and tests method 'calculateSum'
     */
    public function testCalculateSum()
    {
        $diceHand = new \Soln\Dice2\DiceHand();

        $diceHand->roll();
        $diceHand->calculateSum();

        $this->assertIsInt($diceHand->sum());
    }
}
