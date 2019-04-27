<?php
/**
 * Route to dice game.
 */
return [
    "routes" => [
        [
            "info" => "Dice game 100",
            "mount" => "game",
            "handler" => "\Soln\Controller\DiceGameController",
        ],
    ]
];
