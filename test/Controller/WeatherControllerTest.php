<?php

namespace Frbr18\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{
    /**
     * Test the route "index".
     */

    protected $di;
    protected $controller;

    protected function setUp()
    {
        global $di;
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");
        $this->di = $di;
        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertIsObject($res);
    }

    public function testDarkskyIpActionGet()
    {
        $res = $this->controller->darkskyIpActionGet();
        $this->assertIsObject($res);
    }

    public function testDarkskyCordActionGet()
    {
        $res = $this->controller->darkskyCordActionGet();
        $this->assertIsObject($res);
    }
}
