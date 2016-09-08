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
        new \Doctrine\ORM\Mapping\ClassMetadata(
            \App\Tasks\Entity\Task::class
        )
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

/**
 * Patch Task Controller.
 * @return \App\Tasks\Controller\PatchController
 */
$app['tasks.patch.controller'] = function () use ($app) {
    return new \App\Tasks\Controller\PatchController(
        $app['dispatcher'],
        $app['tasks.repository']
    );
};

/**
 * Get Task Controller.
 * @return \App\Tasks\Controller\GetController
 */
$app['tasks.get.controller'] = function () use ($app) {
    return new \App\Tasks\Controller\GetController(
        $app['tasks.repository']
    );
};

/**
 * User Factory.
 * @return \App\Users\Entity\UserFactory
 */
$app['users.factory'] = function () use ($app) {
    return new \App\Users\Entity\UserFactory(
        $app['security.default_encoder']
    );
};

/**
 * User Gateway.
 * @return \App\Common\Gateway\GatewayInterface
 */
$app['users.gateway'] = function () use ($app) {
    return new \App\Users\Gateway\UserGateway(
        $app['orm.em'],
        new \Doctrine\ORM\Mapping\ClassMetadata(
            \App\Users\Entity\User::class
        )
    );
};

/**
 * User Repository.
 * @return \App\Users\Repository\UserRepository
 */
$app['users.repository'] = function () use ($app) {
    return new \App\Users\Repository\UserRepository(
        $app['users.factory'],
        $app['users.gateway']
    );
};

$app['users.provider'] = function () use ($app) {
    return new \App\Security\Provider\UserProvider(
        $app['users.repository']
    );
};

/**
 * Get User Controller.
 * @return \App\Users\Controller\GetController
 */
$app['users.get.controller'] = function () use ($app) {
    return new \App\Users\Controller\GetController(
        $app['dispatcher'],
        $app['users.repository']
    );
};

/**
 * Post User Controller.
 * @return \App\Users\Controller\PostController
 */
$app['users.post.controller'] = function () use ($app) {
    return new \App\Users\Controller\PostController(
        $app['dispatcher'],
        $app['users.repository']
    );
};

/**
 * @return \App\Security\Authenticator\JwsAuthenticator
 */
$app['jws.authenticator'] = function () use ($app, $config) {
    return new \App\Security\Authenticator\JwsAuthenticator(
        $app['users.repository'],
        $config['jws']['public.key.path']
    );
};

$app['users.credentials.controller'] = function () use ($app, $config) {
    return new \App\Security\Controller\CredentialsController(
        $app['dispatcher'],
        $app['users.provider'],
        $app['security.default_encoder'],
        [
            'private.key.path' => $config['jws']['private.key.path'],
            'private.key.phrase' => $config['jws']['private.key.phrase']
        ]
    );
};
