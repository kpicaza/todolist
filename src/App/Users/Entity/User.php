<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User.
 */
class User implements UserInterface, \JsonSerializable
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var null
     */
    private $salt;

    /***
     * @var null
     */
    private $password;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     */
    private $updatedAt;

    /**
     * User constructor.
     *
     * @param UserId $id
     * @param $username
     * @param $email
     * @param null  $pass
     * @param array $roles
     * @param null  $salt
     */
    public function __construct(UserId $id, $username, $email, $pass = null, array $roles = array(), $salt = null)
    {
        $this->id = $id;

        if (empty($username)) {
            throw new \InvalidArgumentException(
                'Username cannot be empty'
            );
        }

        $this->username = $username;

        if (empty($email)) {
            throw new \InvalidArgumentException(
                'Email cannot be empty'
            );
        }

        $this->email = $email;
        $this->password = $pass;
        $this->roles = $roles;
        $this->salt = $salt;
    }

    /**
     * @return UserId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     *
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'id' => (string) $this->id(),
            'username' => $this->username,
            'email' => $this->email
        ];
    }
}
