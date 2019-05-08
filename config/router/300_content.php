<?php
/**
 * Route to dice game.
 */
return [
    "routes" => [
        [
            "info" => "Route for content database",
            "mount" => "content",
            "handler" => "\Soln\Content\ContentController",
        ],
    ]
];
