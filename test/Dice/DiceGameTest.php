<?php

namespace Soln\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceGameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectWithArguments()
    {
        $game = new \Soln\Dice\DiceGame("Test name", 3);
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);
    }

    /**
     *  Construct object and tests method 'diceHand'
     */
    public function testDiceHand()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $res = $game->diceHand();
        $exp = 2;
        $this->assertEquals($exp, sizeof($res));
    }

    /**
     * Construct object and tests method 'playerName'.
     */
    public function testPlayerName()
    {
        $game = new \Soln\Dice\DiceGame("Test name");
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $res = $game->playerName()[0];
        $exp = "Test name";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'currentPlayer'
     */
    public function testCurrentPlayer()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $res = $game->currentPlayer();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'changePlayer'
     */
    public function testChangePlayer()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $game->changePlayer();
        $res = $game->currentPlayer();
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'endGame'
     * with expected result player has won the game.
     */
    public function testPlayerWin()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $sum = $game->diceHand()[0]->sum();

        while ($sum < 101) {
            $game->diceHand()[0]->roll();
            $game->diceHand()[0]->calculateSum();
            $sum = $game->diceHand()[0]->sum();
        }

        $game->diceHand()[0]->setPoints();
        $res = $game->endGame();
        $exp = "Du har vunnit spelet!";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'endGame'
     * with expected result computer has won the game.
     */
    public function testComputerWin()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $sum = $game->diceHand()[1]->sum();

        while ($sum < 101) {
            $game->diceHand()[1]->roll();
            $game->diceHand()[1]->calculateSum();
            $sum = $game->diceHand()[1]->sum();
        }

        $game->diceHand()[1]->setPoints();
        $res = $game->endGame();
        $exp = "Datorn har vunnit spelet!";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'endGame'
     * with expected result game is not over.
     */
    public function testGameNotOver()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $game->diceHand()[1]->roll();
        $game->diceHand()[1]->setPoints();

        $res = $game->endGame();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'autoPlay'.
     */
    public function testAutoPlay()
    {
        $game = new \Soln\Dice\DiceGame();
        $this->assertInstanceOf("\Soln\Dice\DiceGame", $game);

        $res = $game->autoPlay();
        if (in_array(1, $game->diceHand()[1]->values())) {
            $exp = "";
        } else {
            $exp = "Datorn har kastat färdigt";
        }
        $this->assertEquals($exp, $res);
    }
}
