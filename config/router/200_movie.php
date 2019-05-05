<?php
/**
 * Route to dice game.
 */
return [
    "routes" => [
        [
            "info" => "Route for movie database",
            "mount" => "movie",
            "handler" => "\Soln\Movie\MovieController",
        ],
    ]
];
