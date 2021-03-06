<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Repository;

use App\Common\Gateway\GatewayInterface;
use App\Organizations\Entity\OrganizationInterface;
use App\Users\Entity\UserFactory;
use App\Users\Entity\UserInterface;

/**
 * Class UserRepository.
 */
class UserRepository
{
    /**
     * User factory.
     *
     * @var UserFactory
     */
    private $factory;

    /**
     * User gateway.
     *
     * @var GatewayInterface
     */
    private $gateway;

    /**
     * UserRepository constructor.
     *
     * @param UserFactory      $factory
     * @param GatewayInterface $gateway
     */
    public function __construct(UserFactory $factory, GatewayInterface $gateway)
    {
        $this->factory = $factory;
        $this->gateway = $gateway;
    }

    /**
     * Get net User identity.
     *
     * @param $username
     * @param $email
     * @param $pass
     * @param array $roles
     *
     * @return UserInterface
     */
    public function nextIdentity(
        OrganizationInterface $organization,
        $username,
        $email,
        $pass,
        array $roles = ['ROLE_USER']
    ) {
        return $this->factory->make(null, $organization, $username, $email, $pass, $roles);
    }

    /**
     * Save an User.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function save(UserInterface $user)
    {
        $this->gateway->save($user);

        return $user;
    }

    /**
     * Find a  User.
     *
     * @param array $criteria
     *
     * @return UserInterface
     */
    public function findOneBy(array $criteria = [])
    {
        return $this->gateway->findOneBy($criteria);
    }
}
