<?php

require_once __DIR__ . '/bootstrap.php';

$app = new Silex\Application();

require_once __DIR__ . '/config/parameters_dev.php';
require_once __DIR__ . '/config/providers_dev.php';
require_once __DIR__ . '/config/services.php';
require_once __DIR__ . '/config/routes.php';

$app['debug'] = true;

return $app;
