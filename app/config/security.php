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
            'users' => array(
                // raw password is foo
                'admin' => array('ROLE_ADMIN', '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a'),
            ),
//            'users' => function () use ($app) {
//                return new \App\Common\Security\Provider\HMacUserProvider($app['orm.em']);
//            },
        ]
    ],
    'security.role_hierarchy' => [
        'ROLE_ADMIN' => ['ROLE_USER'],
    ],
    'security.access_rules' => [
        ['^/admin', 'ROLE_ADMIN', 'https'],
//        ['^.*$', 'ROLE_USER'],
    ]
];
