<?php

$app['security.default_encoder'] = function ($app) {
    return $app['security.encoder.bcrypt'];
};

$security = [
    'security.firewalls' => [
        'api_v1' => [
            'pattern' => '^/api/v1',
            'http' => true,
            'stateless' => true,
            'anonymous' => true,
            'guard' => [
                'authenticators' => [
                    'jws.authenticator',
                ]
            ],
            'users' => function () use ($app) {
                return new \App\Security\Provider\UserProvider(
                    $app['users.repository']
                );
            },
        ],
        'app' => [
            'pattern' => '^/',
            'http' => true,
            'stateless' => false,
            'anonymous' => true,
            'users' => function () use ($app) {
                return new \App\Security\Provider\UserProvider(
                    $app['users.repository']
                );
            },
        ]
    ],
    'security.role_hierarchy' => [
        'ROLE_ADMIN' => ['ROLE_USER'],
    ],
    'security.access_rules' => [
        ['^/api/v1/users/credentials', 'IS_AUTHENTICATED_ANONYMOUSLY'],
        ['^/api/v1/users', 'IS_AUTHENTICATED_ANONYMOUSLY', ['POST']],
        ['^/login', 'IS_AUTHENTICATED_ANONYMOUSLY'],
        ['^/admin', 'ROLE_ADMIN'/*, 'https'*/],
        ['^/', 'ROLE_USER'],
    ]
];
