<?php

namespace Soln\Dice2;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceGameExceptionTest extends TestCase
{
    /**
     * @expectedException \Soln\Dice2\DiceException
     * @expectedExceptionMessage Ange ett nummer mellan 1-5
     */
    public function testDiceNumberTooHigh()
    {
        $game = new \Soln\Dice2\DiceGame("Test name", 7);
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);
    }

    /**
     * @expectedException \Soln\Dice2\DiceException
     * @expectedExceptionMessage Ange ett nummer mellan 1-5
     */
    public function testDiceNumberTooLow()
    {
        $game = new \Soln\Dice2\DiceGame("Test name", 0);
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);
    }
}
