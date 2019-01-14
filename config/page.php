<?php
/**
 * Configuration file for page which can create and put together web pages
 * from a collection of views. Through configuration you can add the
 * standard parts of the page, such as header, navbar, footer, stylesheets,
 * javascripts and more.
 */
return [
    // This layout view is the base for rendering the page, it decides on where
    // all the other views are rendered.
    "layout" => [
        "region" => "layout",
        "template" => "anax/v2/layout/dbwebb_se",
        //"template" => "anax/v2/layout/default",
        "data" => [
            "baseTitle" => " | Grammatikgrottan",
            "bodyClass" => null,
            "favicon" => "favicon.ico",
            //"favicon" => "logo.ico",
            "htmlClass" => null,
            "lang" => "sv",
            "stylesheets" => [
                //"css/dbwebb-se.min.css",
                "css/min-stajl.css",
            ],
            "javascripts" => [
                "js/responsive-menu.js"

            ],
        ],
    ],

    // These views are always loaded into the collection of views.
    "views" => [
        [
            "region" => "header-col-1",
            "template" => "anax/v2/header/site_logo",
            "data" => [
                "class" => "large",
                "siteLogo"      => "image/logo.png",
                "siteLogoAlt"   => "ojoj",
            ],
        ],
        [
          "region" => "header-col-1",
             "template" => "anax/v2/header/site_logo_text",
             "data" => [
                 "homeLink"      => "",
                 "siteLogoText"  => "",
                 "siteLogoTextIcon" => "image/Grammatikgrottan-logga.png",
                 "siteLogoTextIconAlt" => "logga",
             ],
        ],
        [
            "region" => "header-col-2",
            "template" => "anax/v2/navbar/navbar_submenus",
            "data" => [
                "navbarConfig" => require __DIR__ . "/navbar/header.php",
            ],
        ],
        [
            "region" => "header-col-3",
            "template" => "anax/v2/navbar/responsive_submenus",
            "data" => [
                "navbarConfig" => require __DIR__ . "/navbar/responsive.php",
                "siteLogoText" => "kuken",
                "siteLogo"=>"image/logo.jpg"
            ],
        ],
        [
            "region" => "footer",
            "template" => "anax/v2/columns/multiple_columns",
            "data" => [
                "class"  => "footer-column",
                "columns" => [
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-1",
                    ],
                    [
                        "template" => "anax/v2/block/default",
                        "contentRoute" => "block/footer-col-2",
                    ],
                    // [
                    //      "template" => "anax/v2/block/default",
                    //      "contentRoute" => "block/footer-col-3",
                    // ],
                    [
                         "template" => "anax/v2/footer3/footer3",
                         //"contentRoute" => "block/footer-col-2",
                    ],
                ]
            ],
            "sort" => 1
        ],
        [
            "region" => "footer",
            "template" => "anax/v2/block/default",
            "data" => [
                "class"  => "site-footer",
                "contentRoute" => "block/footer",
            ],
            "sort" => 2
        ],
        [//egen av klas så att banderollen kommer med på alla sidor
            "region" => "flash",
            "template"=> "anax/v2/image/default",
            "data" => [
                "src" => "image/grotta.jpg?width=1100&height=150&crop-to-fit&area=0,0,30,0"
                    ]
        ]
    ],
];
