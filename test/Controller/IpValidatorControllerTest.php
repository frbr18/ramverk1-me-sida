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

    protected $di;

    protected function setUp()
    {
        global $di;
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->di = $di;
    }

    public function testIndexActionGet()
    {
        // Start the controller
        $controller = new IpValidatorController();
        $controller->setDI($this->di);
        $controller->initialize();

        $res = $controller->indexActionGet();
        $this->assertIsObject($res);
    }

    public function testIndexActionPost()
    {
        $controller = new IpValidatorController();
        $controller->setDI($this->di);
        $controller->initialize();

        $res = $controller->indexActionPost();
        $this->assertIsObject($res);
    }

    public function testIpstackActionPost()
    {
        $controller = new IpValidatorController();
        $controller->setDI($this->di);
        $controller->initialize();

        $res = $controller->ipstackActionPost();
        $this->assertIsObject($res);
    }

    public function testIpstackActionGet()
    {
        $controller = new IpValidatorController();
        $controller->setDI($this->di);
        $controller->initialize();

        $res = $controller->ipstackActionGet();
        $this->assertIsObject($res);
    }
}
