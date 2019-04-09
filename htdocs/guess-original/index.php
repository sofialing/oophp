<?php
/**
 * Guess my number
 */

require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";

// Start new session
session_name("soln18");
session_start();

// Deal with incoming variables
$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$game = new Guess();

// Get current game status from the session
$tries = $_SESSION["tries"] ?? null;
$number = $_SESSION["number"] ?? null;

// Init game and make guess
if ($doInit) {
    $number = $game->random();
    $tries = $game->tries();
} elseif ($doGuess) {
    $game = new Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $tries = $game->tries();
} elseif ($tries === null) {
    $tries = $game->tries();
}

// Save game status in session
$_SESSION["number"] = $number;
$_SESSION["tries"] = $tries;
// $_SESSION = [];

// Render the page
require __DIR__ . "/view/header.php";
require __DIR__ . "/view/game.php";
