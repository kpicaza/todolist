<?php

use App\Tasks\Controller\Provider\TasksProvider;

$app->mount('/api/v1/tasks', new TasksProvider());

$app->post('/api/v1/users', 'users.post.controller:postAction');
