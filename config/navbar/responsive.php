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
            "title" => "Presentation av Christoffer Lymalm.",
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
                    ],
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
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "dokumentation/kmom01",
                        "title" => "Kmom01",
                    ],
                    [
                        "text" => "Markdown",
                        "url" => "dokumentation/markdown",
                        "title" => "Markdown",
                    ],
                    [
                        "text" => "Markdown, länkar och bilder",
                        "url" => "dokumentation/markdown-lankar-och-bilder",
                        "title" => "Markdown, länkar och bilder",
                    ],
                    [
                        "text" => "Shortcode",
                        "url" => "dokumentation/shortcode",
                        "title" => "Shortcode",
                    ],
                    [
                        "text" => "Frontmatter",
                        "url" => "dokumentation/frontmatter",
                        "title" => "Frontmatter",
                    ],
                    [
                        "text" => "Styleväljare",
                        "url" => "dokumentation/stylevaljare",
                        "title" => "Stylevaljare",
                    ],
                    [
                        "text" => "Konfigurera befintligt tema",
                        "url" => "dokumentation/konfigurera-befintligt-tema",
                        "title" => "Konfigurera befintligt tema",
                    ],
                    [
                        "text" => "Bygg befintligt tema från källkod",
                        "url" => "dokumentation/bygg-befintligt-tema-fran-kallkod",
                        "title" => "Bygg befintligt tema från källkod",
                    ],
                    [
                        "text" => "Font Awesome",
                        "url" => "dokumentation/font-awesome",
                        "title" => "Font Awesome",
                    ],
                    [
                        "text" => "Layout och regioner",
                        "url" => "dokumentation/layout-och-regioner",
                        "title" => "Layout och regioner",
                    ],
                    [
                        "text" => "Horisontellt (typografiskt) grid",
                        "url" => "dokumentation/horisontellt-grid",
                        "title" => "Horisontellt (typografiskt) grid",
                    ],
                    [
                        "text" => "Vertikalt grid",
                        "url" => "dokumentation/vertikalt-grid",
                        "title" => "Vertikalt grid",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "dokumentation/kmom02",
                        "title" => "Kmom02",
                    ],
                    [
                        "text" => "Development utilities",
                        "url" => "dokumentation/development-utilities",
                        "title" => "Development utilities",
                    ],
                    [
                        "text" => "Bootstrapping",
                        "url" => "dokumentation/bootstrapping",
                        "title" => "Bootstrapping",
                    ],
                    [
                        "text" => "Router och routes",
                        "url" => "dokumentation/router-och-routes",
                        "title" => "Router och routes",
                    ],
                    [
                        "text" => "Vyer och templatefiler",
                        "url" => "dokumentation/vyer-och-templatefiler",
                        "title" => "Vyer och templatefiler",
                    ],
                    [
                        "text" => "Styla en route",
                        "url" => "dokumentation/styla-en-route",
                        "title" => "Styla en route",
                    ],
                    [
                        "text" => "Kmom03",
                        "url" => "dokumentation/kmom03",
                        "title" => "Kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "dokumentation/kmom04",
                        "title" => "Kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "dokumentation/kmom05",
                        "title" => "Kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "dokumentation/kmom06",
                        "title" => "Kmom06",
                    ],
                    [
                        "text" => "Kmom10",
                        "url" => "dokumentation/kmom10",
                        "title" => "Kmom10.",
                    ],
                    [
                        "text" => "Anax CLI",
                        "url" => "dokumentation/anax-cli",
                        "title" => "Anax CLI",
                    ],
                    [
                        "text" => "Scaffolding",
                        "url" => "dokumentation/scaffolding",
                        "title" => "Scaffolding",
                    ],
                    [
                        "text" => "Övrigt",
                        "url" => "dokumentation/ovrigt",
                        "title" => "Övrigt",
                    ],
                    [
                        "text" => "Att göra",
                        "url" => "dokumentation/att-gora",
                        "title" => "Att göra",
                    ],
                ],
            ],
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
