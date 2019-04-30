<?php

namespace Soln\Dice2;

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
        $game = new \Soln\Dice2\DiceGame();
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

        $res = $game->diceHand();
        $exp = 2;
        $this->assertEquals($exp, sizeof($res));
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectWithArguments()
    {
        $game = new \Soln\Dice2\DiceGame("Test name", 3);
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);
    }

    /**
     * Construct object and tests method 'currentPlayer'
     */
    public function testCurrentPlayer()
    {
        $game = new \Soln\Dice2\DiceGame("Test name");
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

        $res = $game->currentPlayer();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $game->playerName()[0];
        $exp = "Test name";
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'changePlayer'
     */
    public function testChangePlayer()
    {
        $game = new \Soln\Dice2\DiceGame();
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

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
        $game = new \Soln\Dice2\DiceGame();
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

        $game->diceHand()[0]->setPoints(100);
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
        $game = new \Soln\Dice2\DiceGame();
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

        $game->diceHand()[1]->setPoints(100);
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
        $game = new \Soln\Dice2\DiceGame();
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

        $game->diceHand()[1]->setPoints(10);
        $game->diceHand()[1]->setPoints(10);

        $res = $game->endGame();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'autoPlay'.
     */
    public function testComputerAutoPlay()
    {
        $game = new \Soln\Dice2\DiceGame();
        $this->assertInstanceOf("\Soln\Dice2\DiceGame", $game);

        $res = $game->autoPlay();
        $exp = "Datorn har kastat färdigt";

        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'computerMinPoints'.
     */
    public function testComputerMinPoints()
    {
        $game = new \Soln\Dice2\DiceGame();
        $game->diceHand()[1]->setPoints(10);
        $game->diceHand()[0]->setPoints(30);

        $res = $game->computerMinPoints();
        $exp = 20;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and tests method 'autoPlay'.
     */
    public function testComputerMinPoints20()
    {
        $game = new \Soln\Dice2\DiceGame();
        $game->diceHand()[1]->setPoints(10);
        $game->diceHand()[0]->setPoints(45);

        $res = $game->computerMinPoints();
        $exp = 25;
        $this->assertEquals($exp, $res);
    }
}
