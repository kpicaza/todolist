<?php

require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

require_once __DIR__ . '/config/parameters.php';
require_once __DIR__ . '/config/providers.php';
require_once __DIR__ . '/config/services.php';
require_once __DIR__ . '/config/routes.php';

$app['debug'] = true;

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

return $app;
