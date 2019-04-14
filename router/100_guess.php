<?php
/**
 * Create routes for guessing game.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Play the game - show current game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Spela gissa mitt nummer";

    // Get current game status from the session
    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $doCheat = $_SESSION["cheat"] ?? null;

    // Remove saved data from the session
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["cheat"] = null;

    $data = [
        "guess" => $guess,
        "number" => $number,
        "tries" => $tries,
        "doCheat" => $doCheat,
        "res" => $res
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the gamestart
    $game = new Soln\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});

/**
 * Play the game - handle $_POST
 */
$app->router->post("guess/play", function () use ($app) {
    // Deal with incoming variables
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $guess = $_POST["guess"] ?? null;

    // Init a new game
    if ($doInit) {
        return $app->response->redirect("guess/init");
    }

    // Save save in the session and handle guess
    if ($doGuess) {
        $_SESSION["guess"] = $guess;
        return $app->response->redirect("guess/guess");
    }

    // Init cheat mode and redirect back to game page
    if ($doCheat) {
        $_SESSION["cheat"] = $doCheat;
        return $app->response->redirect("guess/play");
    }
});

/**
 * Play the game - make a guess
 */
$app->router->get("guess/guess", function () use ($app) {
    // Get current game status from the session
    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    // Make a guess and save game status in the session
    $game = new Soln\Guess\Guess($number, $tries);
    $_SESSION["res"] = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();

    // Redirect back to game page
    return $app->response->redirect("guess/play");
});
