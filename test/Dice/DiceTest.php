<?php

namespace Soln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $dice = new \Soln\Dice\Dice();
        $this->assertInstanceOf("\Soln\Dice\Dice", $dice);
    }

    /**
     * Construct object and tests method 'getLastRoll'.
     */
    public function testGetLastRoll()
    {
        $dice = new \Soln\Dice\Dice();
        $this->assertInstanceOf("\Soln\Dice\Dice", $dice);

        $res = $dice->roll();
        $exp = $dice->getLastRoll();
        $this->assertEquals($exp, $res);
    }
}
