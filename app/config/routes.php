<?php

use App\Tasks\Controller\Provider\TasksProvider;

$app->mount('/api/v1/tasks', new TasksProvider());
