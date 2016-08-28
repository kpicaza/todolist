<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Security\Provider;

use Namshi\JOSE\SimpleJWS;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class JwsProvider.
 */
class JwsProvider
{
    /**
     * @var UserProviderInterface
     */
    private $provider;

    /**
     * Private key path.
     *
     * @var string
     */
    private $path;

    /**
     * Private Key Phrase.
     *
     * @var string
     */
    private $phrase;

    /**
     * JwsProvider constructor.
     *
     * @param UserProviderInterface $provider
     */
    public function __construct(UserProviderInterface $provider, $path, $phrase)
    {
        $this->provider = $provider;
        $this->path = $path;
        $this->phrase = $phrase;
    }

    /**
     * @param $username
     *
     * @return string
     */
    public function createToken(UserInterface $user)
    {
        $jws = new SimpleJWS([
            'alg' => 'RS256',
        ]);

        $date = new \DateTime('tomorrow');

        $jws->setPayload([
            'uid' => (string) $user->id(),
            'exp' => $date->format('U'),
        ]);

        $privateKey = openssl_pkey_get_private($this->path, $this->phrase);
        $jws->sign($privateKey);

        return $jws->getTokenString();
    }
}
