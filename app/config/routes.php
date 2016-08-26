<?php

$app->get('/tasks', 'tasks.index.controller:getAction');
$app->post('/tasks', 'tasks.post.controller:postAction');
$app->get('/tasks/{id}', 'tasks.get.controller:getAction');
