<?php

/**
 * Load the sample json controller.
 */
return [
    "routes" => [
        [
            "info" => "weather Controller.",
            "mount" => "wApi",
            "handler" => "\Frbr18\Weather\WeatherApiController",
        ],
    ]
];
