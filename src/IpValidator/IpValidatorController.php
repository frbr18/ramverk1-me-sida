<?php


namespace Frbr18\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpValidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    private $db = "not active";

    public function initialize(): void
    {
        // Use to initialise member variables.
        $this->db = "active";
    }

    public function indexActionGet()
    {
        $request = $this->di->get("request");
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
        $data = getIpInfo($ipPost);
        // Convert the data to a json-variable push it into the data
        $dataJSON = json_encode($data, JSON_PRETTY_PRINT);
        $data["jsonData"] = $dataJSON;
        //Render the view
        $page = $this->di->get("page");
        $page->add("ipValidator/index", $data);
        return $page->render();
    }

    public function jsonActionGet()
    {
        $request = $this->di->get("request");
        $ipPost = $request->getGet("ip");
        $json = getIpInfo($ipPost);
        return [$json];
    }
}

function getIpInfo($ipPost)
{
    // Checks if ip-address is valid ipv4 or ipv6
    $validIpv4 = (filter_var($ipPost, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) ? "Valid" : "Invalid";
    $validIpv6 = (filter_var($ipPost, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? "Valid" : "Invalid";
    //Checks if the ip-address has domain
    $domain = ($validIpv4 == "Valid" || $validIpv6 == "Valid") ? gethostbyaddr($ipPost) : "No domain";
    // Set up the data for the view
    $json = [
        "ip" => $ipPost,
        "validIpv4" => $validIpv4,
        "validIpv6" => $validIpv6,
        "domain" => $domain,
    ];
    return $json;
}
