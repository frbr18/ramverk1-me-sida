<?php

namespace Frbr18\IpValidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IpValidatorControllerTest extends TestCase
{
    /**
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        global $di;
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        // Start the controller
        $controller = new IpValidatorController();
        $controller->setDI($di);
        $controller->initialize();

        $res = $controller->indexActionGet();
        $this->assertIsObject($res);
    }

    public function testIndexActionPost()
    {
        global $di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $controller = new IpValidatorController();
        $controller->setDI($di);
        $controller->initialize();

        $res = $controller->indexActionPost();
        $this->assertIsObject($res);
    }

    public function testJsonActionGet()
    {
        global $di;
        // Setup  di
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $request = $di->get("request");
        $request->setGet("ip", "172.217.22.164");
        // Start the controller
        $controller = new IpValidatorController();
        $controller->setDI($di);
        $controller->initialize();

        $res = $controller->jsonActionGet();
        $this->assertIsArray($res);
    }
}
