<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Entity;

use App\Organizations\Entity\OrganizationInterface;

/**
 * Class User.
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
     * User Organization.
     *
     * @var OrganizationInterface
     */
    private $organization;

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
     * @param UserId                $id
     * @param OrganizationInterface $organization
     * @param string                $username
     * @param string                $email
     * @param null                  $pass
     * @param array                 $roles
     * @param null                  $salt
     */
    public function __construct(
        UserId $id,
        OrganizationInterface $organization,
        $username,
        $email,
        $pass = null,
        array $roles = [],
        $salt = null
    ) {
        $this->id = $id;

        if (empty($username)) {
            throw new \InvalidArgumentException(
                'Username cannot be empty'
            );
        }

        $this->organization = $organization;
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
     * Get User email.
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
     * Get User Organization.
     *
     * @return OrganizationInterface
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
    }

    /**
     * Task created datetime.
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Task updated datetime.
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
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id(),
            'organization' => $this->organization->getName(),
            'username' => $this->username,
            'email' => $this->email,
        ];
    }
}
