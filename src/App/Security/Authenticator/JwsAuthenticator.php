<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Security\Authenticator;

use App\Users\Repository\UserRepository;
use Namshi\JOSE\SimpleJWS;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class JwsAuthenticator.
 */
class JwsAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * User Repository.
     *
     * @var UserRepository
     */
    private $repository;

    /**
     * Public Key path.
     *
     * @var string
     */
    private $path;

    /**
     * JwsAuthenticator constructor.
     *
     * @param UserRepository $repository
     * @param $path
     */
    public function __construct(UserRepository $repository, $path)
    {
        $this->repository = $repository;
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     *
     * @param Request                      $request
     * @param AuthenticationException|null $authException
     *
     * @return JsonResponse
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required',
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * {@inheritdoc}
     *
     * @param Request $request
     *
     * @return array|void
     */
    public function getCredentials(Request $request)
    {
        if (!$token = $request->headers->get('Authorization')) {
            // no token? Return null and no other methods will be called
            return;
        }

        // What you return here will be passed to getUser() as $credentials
        return array(
            'token' => trim(str_replace('Bearer ', '', $token)),
        );
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed                 $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return \App\Users\Entity\User|void
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $public_key = openssl_pkey_get_public('file://'.$this->path);

        try {
            $credentials['jws'] = SimpleJWS::load($credentials['token']);

            if (!$credentials['jws']->isValid($public_key)) {
                throw new \InvalidArgumentException();
            }

            $payload = $credentials['jws']->getPayload();
        } catch (\InvalidArgumentException $e) {
            return;
        }

        // if null, authentication will fail
        // if a User object, checkCredentials() is called
        return $this->repository->findOneBy(['id' => $payload['uid']]);
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed         $credentials
     * @param UserInterface $user
     *
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @param Request                 $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => 'Authentication Required',

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * {@inheritdoc}
     *
     * @param Request        $request
     * @param TokenInterface $token
     * @param string         $providerKey
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
