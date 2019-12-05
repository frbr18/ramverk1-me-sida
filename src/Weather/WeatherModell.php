<?php


namespace Frbr18\Weather;

class WeatherModell
{

    private $apiKey;

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    public function getMultiCurlWeather($latitude, $longitude, $past)
    {
        $baseUrl = "https://api.darksky.net/forecast/" . $this->apiKey . "/" . $latitude . "," . $longitude . ",";
        $excludes = "?exclude=minutely,hourly,daily,alerts,flags&extend=currently&lang=sv&units=ca";
        $timestamp = time();
        $options = [
            CURLOPT_RETURNTRANSFER => true,
        ];

        $mh = curl_multi_init();
        $chAll = [];

        for ($i = 0; $i < 2; $i++) {
            $url = $baseUrl . strval($timestamp) . $excludes;
            $ch = curl_init("$url");
            // $ch = curl_init("$url");
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mh, $ch);
            $chAll[] = $ch;
            if ($past == "past") {
                $timestamp -= (60 * 60 * 24);
            } elseif ($past == "future") {
                $timestamp += (60 * 60 * 24);
            }
        }

        $running = null;

        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mh, $ch);
        }

        curl_multi_close($mh);

        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }

        return [$response];
    }
}
