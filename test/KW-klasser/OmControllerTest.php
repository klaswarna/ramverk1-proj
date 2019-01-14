<?php


use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class OmControllerTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup
        $this->startController = new KW\Inlagg\OmController($this->di);
        $this->startController->setDI($this->di);
        //$this->controller->initialize();
    }


    /**
     * Test the function max
     */
    public function testIndexActionGet()
    {
        $res = $this->startController->indexActionGet();
        $this->assertInstanceOf("\Anax\Response\Response", $res);

        $body = $res->getBody();
        $exp = "Om | Grammatikgrottan</title>";
        $this->assertContains($exp, $body);

    }

}
