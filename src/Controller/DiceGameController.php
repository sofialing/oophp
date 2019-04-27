<?php
namespace Soln\Controller;

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

}
