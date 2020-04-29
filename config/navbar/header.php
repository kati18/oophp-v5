<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

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
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                    [
                        "text" => "Kmom03",
                        "url" => "redovisning/kmom03",
                        "title" => "Redovisning för kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "redovisning/kmom05",
                        "title" => "Redovisning för kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "redovisning/kmom06",
                        "title" => "Redovisning för kmom06.",
                    ],
                    [
                        "text" => "Kmom10",
                        "url" => "redovisning/kmom10",
                        "title" => "Redovisning för kmom10.",
                    ]
                ],
            ],
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
            "text" => "Guess game",// text in navbar
            // ->url:http://localhost:8080/oophp/me/redovisa/htdocs/guess-game and file
            // C:\cygwin64\home\katja\dbwebb-kurser\oophp\me\redovisa\content\guess-game\index.md:
            "url" => "guess-game",
            // text in tool-tip when hovering over the text Guess game in navbar:
            "title" => "Play the game guess my number",
        ],
    ],
];
