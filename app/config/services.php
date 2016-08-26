<?php

/**
 * Task Factory.
 * @return \App\Tasks\Entity\TaskFactory
 */
$app['tasks.factory'] = function () {
    return new \App\Tasks\Entity\TaskFactory();
};

/**
 * Task Gateway.
 * @return \App\Common\Gateway\GatewayInterface
 */
$app['tasks.gateway'] = function () use ($app) {
    return new \App\Tasks\Gateway\TaskGateway(
        $app['orm.em'],
        new \Doctrine\ORM\Mapping\ClassMetadata(\App\Tasks\Entity\Task::class)
    );
};

/**
 * Task Repository.
 * @return \App\Tasks\Repository\TaskRepository
 */
$app['tasks.repository'] = function () use ($app) {
    return new \App\Tasks\Repository\TaskRepository(
        $app['tasks.factory'],
        $app['tasks.gateway']
    );
};

/**
 * Index Tasks Controller.
 * @return \App\Tasks\Controller\IndexController
 */
$app['tasks.index.controller'] = function () use ($app) {
    return new \App\Tasks\Controller\IndexController(
        $app['tasks.repository']
    );
};

/**
 * Post Task Controller.
 * @return \App\Tasks\Controller\PostController
 */
$app['tasks.post.controller'] = function () use ($app) {
    return new \App\Tasks\Controller\PostController(
        $app['dispatcher'],
        $app['tasks.repository']
    );
};
