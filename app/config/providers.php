<?php

// Silex Providers.
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), $config['monolog']);
$app->register(new Silex\Provider\FormServiceProvider(), $config['translator']);
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new \Knp\Provider\ConsoleServiceProvider(), $config['console']);
