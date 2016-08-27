<?php

$app['security.default_encoder'] = function ($app) {
    return $app['security.encoder.bcrypt'];
};
//
//$app['security.authentication_listener.factory.jws'] = $app->protect(
//    function ($name, $options) use ($app) {
//        // define the authentication provider object
//        $app['security.authentication_provider.' . $name . '.jws'] = function () use ($app) {
//            return new JwsProvider(
//                $app['security.user_provider.default'],
//                __DIR__ . '/security_cache'
//            );
//        };
//
//        // define the authentication listener object
//        $app['security.authentication_listener.' . $name . '.jws'] = function () use ($app) {
//            return new JwsListener(
//                $app['security.token_storage'],
//                $app['security.authentication_manager']
//            );
//        };
//
//        return [
//            // the authentication provider id
//            'security.authentication_provider.' . $name . '.jws',
//            // the authentication listener id
//            'security.authentication_listener.' . $name . '.jws',
//            // the entry point id
//            null,
//            // the position of the listener in the stack
//            'pre_auth'
//        ];
//    }
//);

$security = [
    'security.firewalls' => [
        'api_v1' => [
            'pattern' => '^/api/v1',
            'http' => true,
            'stateless' => true,
            'anonymous' => true,
            'guard' => [
                'authenticators' => [
                    'jws.authenticator'
                ]
            ],
            'users' => function () use ($app) {
                return new \App\Users\Security\Provider\UserProvider(
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
        ['^/api/v1/users', 'IS_AUTHENTICATED_ANONYMOUSLY', 'POST'],
        ['^/admin', 'ROLE_ADMIN'/*, 'https'*/],
        ['^/', 'ROLE_USER'],
    ]
];
