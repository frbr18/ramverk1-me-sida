<?php

namespace Frbr18\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherApiControllerTest extends TestCase
{
    protected $di;
    protected $controller;

    protected function setUp()
    {
        global $di;
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->controller = new WeatherApiController();

        $this->controller->initialize();
        $request = $di->get("request");
        $request->setGet("ip", "172.217.22.164");
        $request->setGet("lon", "50");
        $request->setGet("lat", "50");
        $request->setGet("past", "past");
        $this->di = $di;
        $this->request = $request;
        $this->controller->setDI($this->di);
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexActionGet();
        $this->assertIsString($res);
    }

    public function testByIpActionGet()
    {
        $res = $this->controller->byIpActionGet();
        $this->assertIsArray($res);
    }

    public function testByIpErrorActionGet()
    {
        $request = $this->di->get("request");
        $request->setGet("ip", "bad");
        $res = $this->controller->byIpActionGet();
        $this->assertIsArray($res);
    }

    public function testByIpFutureActionGet()
    {
        $request = $this->di->get("request");
        $request->setGet("past", "future");
        $res = $this->controller->byIpActionGet();
        $this->assertIsArray($res);
    }

    public function testByCordsActionGet()
    {
        $res = $this->controller->byCordsActionGet();
        $this->assertIsArray($res);
    }
}
