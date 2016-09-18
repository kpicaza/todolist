<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Entity;

/**
 * Class User
 * @package App\Users\Entity
 */
class User implements UserInterface, \JsonSerializable
{
    /**
     * User id.
     *
     * @var UserId
     */
    private $id;

    /**
     * User name.
     *
     * @var string
     */
    private $username;

    /**
     * User email.
     *
     * @var string
     */
    private $email;

    /**
     * User roles.
     *
     * @var array
     */
    private $roles;

    /**
     * Password salt.
     *
     * @var null
     */
    private $salt;

    /**
     * User password.
     *
     * @var null
     */
    private $password;

    /**
     * User created at.
     *
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * User updated at.
     *
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
     * Get User id.
     *
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
     * Get User email
     *
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
     * Get created at.
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updated at.
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *  Set created at.
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set updated at.
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
    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id(),
            'username' => $this->username,
            'email' => $this->email
        ];
    }
}
