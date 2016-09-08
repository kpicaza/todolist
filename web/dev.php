<?php

$app = require_once __DIR__ . '/../app/app_dev.php';

$app->run();
$app->after($app["cors"]);

