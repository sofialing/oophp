<?php

namespace Soln\Dice2;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHistogramTest extends TestCase
{
    use HistogramTrait;
    /**
     * Construct object and tests method 'getHistogramMax'.
     */
    public function testCreateHistogram()
    {
        $dice = new \Soln\Dice2\DiceHistogram();
        $this->assertInstanceOf("\Soln\Dice2\DiceHistogram", $dice);

        $histogram = new \Soln\Dice2\Histogram();
        $this->assertInstanceOf("\Soln\Dice2\Histogram", $histogram);
    }

    /**
     * Construct object and tests method 'getHistogramSerie'.
     */
    public function testGetHistogramSerie()
    {
        $dice = new \Soln\Dice2\DiceHistogram();
        $dice->roll();

        $res = count($dice->getHistogramSerie());
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'getHistogramMax'.
     */
    public function testGetHistogramMax()
    {
        $dice = new \Soln\Dice2\DiceHistogram();
        $dice->roll();

        $histogram = new \Soln\Dice2\Histogram();
        $histogram->injectData($dice);

        $this->assertIsInt($dice->getHistogramMax());
    }

    /**
     * Construct object and tests method 'getAsText'.
     */
    public function testGetHistogramAsText()
    {
        $dice = new \Soln\Dice2\DiceHistogram();
        $dice->roll();

        $histogram = new \Soln\Dice2\Histogram();
        $histogram->injectData($dice);

        $this->assertIsString($histogram->getAsText());
    }
}
