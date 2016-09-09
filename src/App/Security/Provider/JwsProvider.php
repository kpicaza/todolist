<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Security\Provider;

use Namshi\JOSE\SimpleJWS;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class JwsProvider
 * @package App\Security\Provider
 */
class JwsProvider
{
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
     * @param $path
     * @param $phrase
     */
    public function __construct($path, $phrase)
    {
        $this->path = $path;
        $this->phrase = $phrase;
    }

    /**
     * Crete authentication token.
     *
     * @param UserInterface $user
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
