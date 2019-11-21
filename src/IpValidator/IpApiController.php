<?php


namespace Frbr18\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IpApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";
    private $modell;

    public function initialize(): void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $this->modell = new IpApiModell();
    }

    public function indexActionGet()
    {
        $request = $this->di->get("request");
        $ipPost = $request->getGet("ip");
        $json = $this->modell->getIpInfo($ipPost);
        return [$json];
    }

    public function ipstackActionGet()
    {
        $request = $this->di->get("request");
        $ip = $request->getGet("ip");
        $result = $this->modell->getIpStack($ip);
        return [$result];
    }
}
