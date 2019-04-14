<?php
/**
 * Create routes for dice game 100.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Play the game - show current game status
 */


/**
 * Init the game and redirect to play the game
 */
$app->router->get("dice-game/init", function () use ($app) {
    $title = "Spela tärningsspelet 100";


    $app->page->add("dice/play");

    return $app->page->render([
        "title" => $title,
    ]);
});
