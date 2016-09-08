<?php

$app->get('/api/v1/users/{id}', 'users.get.controller:getAction');
$app->post('/api/v1/users', 'users.post.controller:postAction');
$app->post('/api/v1/users/credentials', 'users.credentials.controller:postAction');

$app->mount('/api/v1/tasks', new App\Tasks\Controller\Provider\TasksProvider());
