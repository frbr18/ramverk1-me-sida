<?php


namespace Frbr18\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";
    private $modell;

    public function initialize(): void
    {
        $this->db = "active";
        $this->modell = new IpApiModell();
    }

    public function indexActionGet()
    {
        //$request = $this->di->get("request");
        $page = $this->di->get("page");
        $page->add("ipValidator/index");
        return $page->render();
    }

    public function indexActionPost()
    {
        //Get the di request object and the post data
        $request = $this->di->get("request");
        $ipPost = $request->getPost("ip");
        // Checks if ip-address is valid ipv4 or ipv6
        $data = $this->modell->getIpInfo($ipPost);
        // Convert the data to a json-variable push it into the data
        $dataJSON = json_encode($data, JSON_PRETTY_PRINT);
        $data["jsonData"] = $dataJSON;
        //Render the view
        $page = $this->di->get("page");
        $page->add("ipValidator/index", $data);
        return $page->render();
    }

    public function ipstackActionGet()
    {
        $request = $this->di->get("request");
        $data = [
            "default" =>  $request->getServer("REMOTE_ADDR")
        ];
        $page = $this->di->get("page");
        $page->add("ipValidator/ipstack", $data);
        return $page->render();
    }

    public function ipstackActionPost()
    {
        $request = $this->di->get("request");
        $ip = $request->getPost("ip");
        $json = $this->modell->getIpStack($ip);
        $dataJSON = json_encode($json, JSON_PRETTY_PRINT);
        $data = [
            "default" =>  $request->getServer("REMOTE_ADDR"),
            "jsonData" => $dataJSON,
            "ip" => $json['ip'],
            "type" => $json['type'],
            "country" => $json['country'],
            "longitude" => $json['longitude'],
            "latitude" => $json['latitude'],
            "city" => $json['city']
        ];
        $page = $this->di->get("page");
        $page->add("ipValidator/ipstack", $data);
        return $page->render();
    }
}
