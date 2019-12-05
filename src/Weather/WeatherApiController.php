<?php


namespace Frbr18\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Frbr18\Weather\WeatherModell;
use Frbr18\IpValidator\IpApiModell;

class WeatherApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";
    private $wModell;
    private $ipModell;

    public function initialize(): void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $this->wModell = new WeatherModell();
        $this->ipModell = new IpApiModell();
    }

    public function indexActionGet()
    {
        $text = "<h3>GET /wApi/byIp?ip=[THE IP]&past=[past ? future]</h3>";
        $text .= "<p>EXAMPLE: /wApi/byIp?ip=172.217.22.164&past=past</p>";
        $text .= "<p>EXAMPLE: /wApi/byIp?ip=172.217.22.164&past=future</p>";
        $text .= "<h3>GET /wApi/byCords?lat=[LATITUDE]&lon=[LONGITUDE]&past=[past ? future]</h3>";
        $text .= "<p>EXAMPLE: /wApi/byCords?lat=50&lon=50&past=past</p>";
        $text .= "<p>EXAMPLE: /wApi/byCords?lat=50&lon=50&past=future</p>";
        return $text;
    }

    public function byIpActionGet()
    {
        $darksky = $this->di->get("darksky");
        $request = $this->di->get("request");
        $ip = $request->getGet("ip");
        $past = $request->getGet("past");

        $valid = $this->ipModell->checkIp($ip);
        if (!$valid) {
            return [
                "error" => "Ip Not Valid"
            ];
        }
        $ipInfo = $this->ipModell->getIpStack($ip);
        $weatherInfo = $darksky->getMultiCurlWeather($ipInfo["latitude"], $ipInfo["longitude"], $past);
        return [$weatherInfo];
    }

    public function byCordsActionGet()
    {
        $darksky = $this->di->get("darksky");
        $request = $this->di->get("request");
        $lat = $request->getGet("lat");
        $lon = $request->getGet("lon");
        $past = $request->getGet("past");
        $weatherInfo = $darksky->getMultiCurlWeather($lat, $lon, $past);
        return [$weatherInfo];
    }
}
