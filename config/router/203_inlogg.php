<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Controller for log in/out new user",
            "mount" => "inlogg",
            "handler" => "\KW\Inlagg\InloggController",
        ],
    ]
];
