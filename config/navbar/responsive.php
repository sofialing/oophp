<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten."
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Docs",
            "url" => "dokumentation",
            "title" => "Dokumentation av ramverk och liknande.",
        ],
        [
            "text" => "Test &amp; Lek",
            "url" => "lek",
            "title" => "Testa och lek med test- och exempelprogram",
        ],
        [
            "text" => "Anax dev",
            "url" => "dev",
            "title" => "Anax development utilities",
        ],
    ],
];
