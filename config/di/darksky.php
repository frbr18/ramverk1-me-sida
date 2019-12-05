<?php

/**
 * Darksky service.
 */
return [

    // Services to add to the container.
    "services" => [
        "darksky" => [
            "shared" => true,
            "callback" => function () {
                $darksky = new \Frbr18\Weather\WeatherModell;
                $cfg = $this->get("configuration");
                $config = $cfg->load("ApiKeys.php");
                $darksky->setApiKey($config['config']['darksky']);
                return $darksky;
            }
        ],
    ],
];
