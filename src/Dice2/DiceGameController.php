<?php
namespace Soln\Dice2;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

class DiceGameController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Display page to start a new game-
     *
     * @return object
     */
    public function startAction() : object
    {
        $title = "Tärningsspelet 100";

        $page = $this->app->page;
        $session = $this->app->session;

        // Check if saved game exists in session
        if ($session->has('game')) {
            return $this->app->response->redirect("game/play");
        }

        $page->add("dice/start");

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Init a new game
     *
     * @return object
     */
    public function startActionPost() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        // Deal with incoming variables
        $name = $this->app->request->getPost('name');
        $dices = $this->app->request->getPost('dices');

        // Create new game object and store in session
        $game = new \Soln\Dice2\DiceGame($name, $dices);
        $session->set('game', $game);

        return $response->redirect("game/play");
    }

    /**
     * Play the game
     *
     * @return object
     */
    public function playAction() : object
    {
        $title = "Tärningsspelet 100";
        $page = $this->app->page;
        $session = $this->app->session;

        // Get game status
        $game = $session->get('game');

        // Save game data
        $data = [
            "playerPoints" => $game->diceHand()[0]->points(),
            "computerPoints" => $game->diceHand()[1]->points(),
            "name" => $game->playerName(),
            "currentPlayer" => $game->currentPlayer(),
            "lastPlayer" => $session->get('lastPlayer'),
            "lastValues" => $session->get('lastValues'),
            "lastPoints" => $session->get('lastPoints'),
            "lastHistogram" => $session->get('lastHistogram'),
            "endGame" => $game->endGame()
        ];

        $page->add("dice/play", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    /**
     * Play the game - handle incoming input from POST
     *
     * @return object
     */
    public function playActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;

        // Deal with incoming variables and redirect
        if (!$request->getPost('rollDices') == null) {
            $redirect = "game/roll";
        } elseif (!$request->getPost('savePoints') == null) {
            $redirect = "game/save";
        } elseif (!$request->getPost('computer') == null) {
            $redirect = "game/computer";
        } else {
            $redirect = "game/reset";
        }
        return $response->redirect($redirect);
    }

    /**
     * Roll dices
     *
     * @return object
     */
    public function rollAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        // Get game status
        $game = $session->get('game');
        $player = $game->currentPlayer();
        $diceHand = $game->diceHand()[$player];

        // Roll dices and calculate the sum
        $diceHand->roll();
        $diceHand->calculateSum();
        $lastPoints = $diceHand->sum();
        $lastValues = $diceHand->values();
        $lastHistogram = $diceHand->Histogram();

        // Save game status in session
        $session->set('lastPlayer', $player);
        $session->set('lastValues', $lastValues);
        $session->set('lastPoints', $lastPoints);
        $session->set('lastHistogram', $lastHistogram);

        // Change player if dice has value 1
        if (in_array(1, $diceHand->values())) {
            $game->changePlayer();
        }

        return $response->redirect("game/play");
    }

    /**
     * Play as computer
     *
     * @return object
     */
    public function computerAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        // Get game status
        $game = $session->get('game');
        $player = $game->currentPlayer();
        $diceHand = $game->diceHand()[$player];

        // Auto play as computer
        $game->autoPlay();

        // Save current game status in session
        $lastPoints = $diceHand->sum();
        $lastValues = $diceHand->values();
        $lastHistogram = $diceHand->Histogram();
        $session->set('lastPlayer', $player);
        $session->set('lastValues', $lastValues);
        $session->set('lastPoints', $lastPoints);
        $session->set('lastHistogram', $lastHistogram);

        return $response->redirect("game/save");
    }

    /**
     * Save points and change player
     *
     * @return object
     */
    public function saveAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        // Get game status
        $game = $session->get('game');
        $player = $game->currentPlayer();
        $diceHand = $game->diceHand()[$player];

        // Set points and reset current sum
        $diceHand->setPoints($diceHand->sum());
        $diceHand->resetSum();

        // Change current player
        $game->changePlayer();

        // Save game status in the session
        $session->set('game', $game);

        return $response->redirect("game/play");
    }

    /**
     * Reset game and redirect to start new game
     *
     * @return object
     */
    public function resetAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;

        // Delete game status from session
        $session->delete('game');
        $session->delete('lastPlayer');
        $session->delete('lastPoints');
        $session->delete('lastValues');
        $session->delete('lastHistogram');

        return $response->redirect("game/start");
    }
}
