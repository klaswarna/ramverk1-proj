<?php


use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class HamtarenTest extends TestCase
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

        // Setup the controller
        $this->hamtaren = new KW\Inlagg\Hamtaren($this->di);
        //$this->controller->setDI($this->di);
        //$this->controller->initialize();
    }


    /**
     * Test the function max
     */
    public function testMax()
    {
        $res = $this->hamtaren->max(100);
        $this->assertEquals(80, $res);

    }

}
