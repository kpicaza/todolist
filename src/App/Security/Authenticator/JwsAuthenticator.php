<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 27/08/16
 * Time: 20:30.
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

class JwsAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var string Public Key
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
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * {@inheritdoc}
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
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // on success, let the request continue
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
