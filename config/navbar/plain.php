<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",
 
    // Here comes the menu items/structure
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Presentation av Christoffer Lymalm.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
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
        [
            "text" => "Spel",
            "url" => "games",
            "title" => "Olika spel",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Guess Game",
                        "url" => "games/guess-game",
                        "title" => "Spela gissa mitt nummer",
                    ],
                    [
                        "text" => "Dice Game",
                        "url" => "games/dice-game",
                        "title" => "Spela tärningsspel 100",
                    ],
                ],
            ],
        ],
    ],
];
