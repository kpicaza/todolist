<?php

/**
 * This file is part of TodoList\Users package.
 */

namespace App\Users\Entity;

use App\Organizations\Entity\OrganizationInterface;
use Symfony\Component\Security\Core\User\UserInterface as BaseUser;

/**
 * Interface UserInterface
 *
 * @package App\Users\Entity
 */
interface UserInterface extends BaseUser
{
    /**
     * Get User id.
     *
     * @return mixed
     */
    public function id();

    /**
     * Get User Organization.
     *
     * @return OrganizationInterface
     */
    public function getOrganization();
}
