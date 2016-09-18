<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;

/**
 * Interface OrganizationInterface
 * @package App\Organizations\Entity
 */
interface OrganizationInterface
{
    /**
     * Get Organization id.
     *
     * @return mixed
     */
    public function id();

    /**
     * Get Organization name.
     *
     * @return mixed
     */
    public function getName();
}
