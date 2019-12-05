<?php


namespace Frbr18\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Frbr18\Weather\WeatherModell;
use Frbr18\IpValidator\IpApiModell;

class WeatherController implements ContainerInjectableInterface
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
        $page = $this->di->get("page");
        $page->add("weatherMap/index");
        return $page->render();
    }

    public function darkskyIpActionGet()
    {
        $request = $this->di->get("request");
        $darksky = $this->di->get("darksky");
        $ipPost = $request->getGet("ip");
        $past = $request->getGet("past");
        $ipInfo = $this->ipModell->getIpStack($ipPost);
        $weather = $darksky->getMultiCurlWeather($ipInfo["latitude"], $ipInfo["longitude"], $past);
        $page = $this->di->get("page");
        $page->add("weatherMap/darksky", $weather[0]);
        return $page->render();
    }

    public function darkskyCordActionGet()
    {
        $request = $this->di->get("request");
        $darksky = $this->di->get("darksky");
        $lon = $request->getGet("longitude");
        $lat = $request->getGet("latitude");
        $past = $request->getGet("past");
        $weather = $darksky->getMultiCurlWeather($lat, $lon, $past);
        $page = $this->di->get("page");
        $page->add("weatherMap/darksky", $weather[0]);
        return $page->render();
    }
}
