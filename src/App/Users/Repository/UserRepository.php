<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Repository;

use App\Common\Gateway\GatewayInterface;
use App\Users\Entity\UserFactory;

class UserRepository
{
    /**
     * @var UserFactory
     */
    private $factory;

    /**
     * @var GatewayInterface
     */
    private $gateway;

    /**
     * TaskRepository constructor.
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
     * @param $username
     * @param $email
     * @param $pass
     *
     * @return \App\Users\Entity\User
     */
    public function insert($username, $email, $pass)
    {
        $user = $this->factory->make($username, $email, $pass);

        $this->gateway->save($user);

        return $user;
    }

    /**
     * @param array $criteria
     *
     * @return \App\Users\Entity\User
     */
    public function findOneBy(array $criteria = [])
    {
        return $this->gateway->findOneBy($criteria);
    }
}
