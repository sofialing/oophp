<?php

namespace Soln\Dice2;

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
        $dice = new \Soln\Dice2\Dice();
        $this->assertInstanceOf("\Soln\Dice2\Dice", $dice);
    }

    /**
     * Construct object and tests method 'getLastRoll'.
     */
    public function testGetLastRoll()
    {
        $dice = new \Soln\Dice2\Dice();
        $this->assertInstanceOf("\Soln\Dice2\Dice", $dice);

        $res = $dice->roll();
        $exp = $dice->getLastRoll();
        $this->assertEquals($exp, $res);
    }
}
