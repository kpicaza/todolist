<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Security\Controller;

use App\Security\Provider\JwsProvider;
use App\Security\Provider\UserProvider;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class CredentialsController.
 */
class CredentialsController
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var UserProvider
     */
    private $provider;

    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var array
     */
    private $options;

    /**
     * User CredentialsController constructor.
     *
     * @param EventDispatcherInterface     $eventDispatcher
     * @param UserProviderInterface        $provider
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        UserProviderInterface $provider,
        PasswordEncoderInterface $encoder,
        array $options
    ) {
        $this->dispatcher = $eventDispatcher;
        $this->provider = $provider;
        $this->encoder = $encoder;
        $this->options = $options;
    }

    public function postAction(Request $request)
    {
        $data = $request->request->all();

        try {
            if (!array_key_exists('username', $data)) {
                throw new \RuntimeException(
                    'Username cannot be empty.'
                );
            }
            if (!array_key_exists('password', $data)) {
                throw new \RuntimeException(
                    'Password cannot be empty.'
                );
            }

            $user = $this->provider->loadUserByUsername($data['username']);

            if (!$this->encoder->isPasswordValid($user->getPassword(), $data['password'], '')) {
                throw new \RuntimeException(
                    'Invalid username or password.'
                );
            }

            $authorizationProvider = new JwsProvider(
                'file://'.$this->options['private.key.path'],
                $this->options['private.key.phrase']
            );

            $response = new JsonResponse([
                'access_token' => $authorizationProvider->createToken($user),
                'uuid' => $user->id()
            ], Response::HTTP_OK);
        } catch (\RuntimeException $e) {
            return new JsonResponse('', Response::HTTP_UNAUTHORIZED);
        }

        return $response;
    }
}
