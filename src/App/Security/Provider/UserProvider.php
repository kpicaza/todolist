<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Security\Provider;

use App\Users\Entity\User;
use App\Users\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class UserProvider.
 */
class UserProvider implements UserProviderInterface
{
    /**
     * User repository.
     *
     * @var UserRepository
     */
    private $repository;

    /**
     * UserProvider constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Load User by username.
     *
     * @param $username
     *
     * @return UserInterface
     */
    public function loadUserByUsername($username)
    {
        $user = $this->repository->findOneBy(['username' => $username]);
        if (!$user) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return $user;
    }

    /**
     * Refresh a User.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return in_array($class, [
            User::class,
        ], true);
    }
}
