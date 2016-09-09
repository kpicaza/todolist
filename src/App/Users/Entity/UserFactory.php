<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Entity;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * Class UserFactory
 * @package App\Users\Entity
 */
class UserFactory
{
    /**
     * Password encoder.
     *
     * @var PasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserFactory constructor.
     *
     * @param PasswordEncoderInterface $encoder
     */
    public function __construct(PasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Create a User.
     *
     * @param $username
     * @param $email
     * @param $password
     *
     * @return User
     */
    public function make($username, $email, $password)
    {
        $id = new UserId(Uuid::uuid4());

        return new User(
            $id,
            $username,
            $email,
            $this->encoder->encodePassword(
                $password,
                ''
            )
        );
    }
}
