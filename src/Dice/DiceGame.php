<?php
namespace Soln\Dice;

/**
 * Create a new dice game
 */
class DiceGame
{
    /**
     * @var int $dices The number of dices in current game.
     * @var array $diceHand Array consisting of the players dice hands.
     * @var array $name Array consisting of the players names.
     * @var int $currentName The number of the current player.
     */
    private $dices;
    private $diceHand;
    private $name = [];
    private $currentPlayer;

    /**
     * Constructor to initiate a new game
     *
     * @throws DiceException when $nrOfDices is too low or high.
     *
     */
    public function __construct(string $playerName = "Joe Doe", int $nrOfDices = 2, int $nrOfPlayers = 2)
    {
        $this->name = $playerName;
        $this->dices = $nrOfDices;
        $this->currentPlayer = 0;
        $this->name = array($playerName, "Datorn");

        if ($nrOfDices > 5 || $nrOfDices < 1) {
            throw new DiceException("Ange ett nummer mellan 1-5");
        }

        for ($i = 0; $i < $nrOfPlayers; $i++) {
            $this->diceHand[$i]  = new DiceHand($this->dices);
        }
    }

    /**
     * Get the players dice hands
     *
     * @return array consisting of the players dice hands.
     */
    public function diceHand()
    {
        return $this->diceHand;
    }

    /**
     * Get the players names
     *
     * @return array consisting of the players names.
     */
    public function playerName()
    {
        return $this->name;
    }

    /**
     * Get the players histogram
     *
     * @return array consisting of the players names.
     */
    public function histogram()
    {
        return $this->histogram;
    }

    /**
     * Get the current player
     *
     * @return int the number of the current players
     */
    public function currentPlayer()
    {
        return $this->currentPlayer;
    }

    /**
     * Change the current player
     *
     * @return void
     */
    public function changePlayer()
    {
        ($this->currentPlayer === 0) ? $this->currentPlayer = 1 : $this->currentPlayer = 0;
    }

    /**
     * Check if game is over
     *
     * @return string the result of the game
     */
    public function endGame()
    {
        if ($this->diceHand[0]->points() >= 100) {
            return "Du har vunnit spelet!";
        } elseif ($this->diceHand[1]->points() >= 100) {
            return "Datorn har vunnit spelet!";
        }
        return null;
    }

    /**
     * Play as computer
     *
     * @return string
     */
    public function autoPlay()
    {
        $min = 15;
        $sum = 0;
        $diceHand = $this->diceHand[$this->currentPlayer];

        while ($sum < $min) {
            $diceHand->roll();
            $diceHand->calculateSum();
            $sum = $diceHand->sum();

            if (in_array(1, $diceHand->values())) {
                break;
            }
        }

        return "Datorn har kastat färdigt";
    }
}
