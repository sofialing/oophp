<?php

namespace Soln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class DiceGameExceptionTest extends TestCase
{
    /**
     * @expectedException \Soln\Dice\DiceException
     * @expectedExceptionMessage Ange ett nummer mellan 1-5
     */
    public function testDiceGameTooHigh()
    {
        $game = new \Soln\Dice\DiceGame("Test name", 7);
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);
    }

    /**
     * @expectedException \Soln\Dice\DiceException
     * @expectedExceptionMessage Ange ett nummer mellan 1-5
     */
    public function testDiceGameTooLow()
    {
        $game = new \Soln\Dice\DiceGame("Test name", 0);
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);
    }
}
