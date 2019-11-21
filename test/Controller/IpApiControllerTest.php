<?php

namespace Frbr18\IpValidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpApiControllerTest extends TestCase
{
    protected $di;

    protected function setUp()
    {
        global $di;
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $request = $di->get("request");
        $request->setGet("ip", "172.217.22.164");
        $this->di = $di;
        $this->request = $request;
    }

    public function testIndexActionGet()
    {
        // Start the controller
        $controller = new IpApiController();
        $controller->setDI($this->di);
        $controller->initialize();

        $res = $controller->indexActionGet();
        $this->assertIsArray($res);
    }

    public function testIpstackActionGet()
    {
        // Start the controller
        $controller = new IpApiController();
        $controller->setDI($this->di);
        $controller->initialize();

        $res = $controller->ipstackActionGet();
        $this->assertIsArray($res);
    }
}
