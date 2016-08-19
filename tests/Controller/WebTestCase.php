<?php

namespace Tests\Controller;

use Silex\WebTestCase as BaseTestCase;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class WebTestCase extends BaseTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Creates the application.
     *
     * @return HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../app/app_test.php';
        unset($app['exception_handler']);

        return $app;
    }

    public function getApplicationDir()
    {
        return $_SERVER['APP_DIR'];
    }
}