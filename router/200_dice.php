<?php

namespace Soln\Dice;

/**
 * Create routes for dice game 100.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Start new game
 */
$app->router->get("dice/start", function () use ($app) {
    $title = "Tärningsspelet 100";

    if (isset($_SESSION["game"])) {
        return $app->response->redirect("dice/play");
    }

    $app->page->add("dice/start");

    return $app->page->render([
         "title" => $title,
    ]);
});

/**
 * Start new game - handle $_POST
 */
$app->router->post("dice/start", function () use ($app) {
    // Deal with incoming variables
    $name = $_POST["name"] ?? "Joe Doe";
    $dices = $_POST["dices"] ?? null;

    // Create new game object and store in session
    $_SESSION["game"] = new \Soln\Dice\DiceGame($name, $dices);

    // Redirect to play game
    return $app->response->redirect("dice/play");
});

/**
 * Play the game
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Tärningsspelet 100";
    // Deal with incoming variables
    $game = $_SESSION["game"];
    $lastPlayer = $_SESSION["lastPlayer"] ?? null;
    $lastValues = $_SESSION["lastValues"] ?? null;
    $lastPoints = $_SESSION["lastPoints"] ?? null;

    $data = [
        "playerPoints" => $game->diceHand()[0]->points(),
        "computerPoints" => $game->diceHand()[1]->points(),
        "name" => $game->playerName(),
        "currentPlayer" => $game->currentPlayer(),
        "lastPlayer" => $lastPlayer,
        "lastValues" => $lastValues,
        "lastPoints" => $lastPoints,
        "endGame" => $game->endGame()
    ];

    $app->page->add("dice/play", $data);

    return $app->page->render([
         "title" => $title,
    ]);
});

/**
 * Play the game - handle $_POST
 */
$app->router->post("dice/play", function () use ($app) {
    if (isset($_POST["rollDices"])) {
        return $app->response->redirect("dice/roll");
    }

    if (isset($_POST["savePoints"])) {
        return $app->response->redirect("dice/save");
    }

    if (isset($_POST["computer"])) {
        return $app->response->redirect("dice/computer");
    }

    // Redirect to reset game
    return $app->response->redirect("dice/reset");
});

/**
 * Roll dices
 */
$app->router->get("dice/roll", function () use ($app) {
    $game = $_SESSION["game"];
    $player = $game->currentPlayer();

    // Roll dices and calculate the sum
    $game->diceHand()[$player]->roll();
    $game->diceHand()[$player]->calculateSum();
    $game->diceHand()[$player]->sum();

    // Save game status in the session
    $_SESSION["lastPlayer"] = $player;
    $_SESSION["lastValues"] = $game->diceHand()[$player]->values();
    $_SESSION["lastPoints"] = $game->diceHand()[$player]->sum();

    if (in_array(1, $game->diceHand()[$player]->values())) {
        $game->changePlayer();
    }

    // Redirect to continue the game
    return $app->response->redirect("dice/play");
});

/**
 * Play as computer
 */
$app->router->get("dice/computer", function () use ($app) {
    $game = $_SESSION["game"];
    $player = $game->currentPlayer();
    $game->autoPlay();

    // Save current game status in session
    $_SESSION["lastPlayer"] = $player;
    $_SESSION["lastValues"] = $game->diceHand()[$player]->values();
    $_SESSION["lastPoints"] = $game->diceHand()[$player]->sum();

    // Redirect to save points and change player
    return $app->response->redirect("dice/save");
});

/**
 * Save points and change player
 */
$app->router->get("dice/save", function () use ($app) {
    $game = $_SESSION["game"];
    $player = $game->currentPlayer();
    $game->diceHand()[$player]->setPoints();
    $game->diceHand()[$player]->resetSum();
    $game->changePlayer();
    $_SESSION["game"] = $game;

    // Redirect to continue the game
    return $app->response->redirect("dice/play");
});

/**
 * Reset session and redirect to start new game
 */
$app->router->get("dice/reset", function () use ($app) {
    unset($_SESSION['game']);
    unset($_SESSION['lastPlayer']);
    unset($_SESSION['lastPoints']);
    unset($_SESSION['lastValues']);

    // Redirect to start new game
    return $app->response->redirect("dice/start");
});
