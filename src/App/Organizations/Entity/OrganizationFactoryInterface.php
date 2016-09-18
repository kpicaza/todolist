<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;

/**
 * Interface OrganizationFactoryInterface
 *
 * @package App\Organizations\Entity
 */
interface OrganizationFactoryInterface
{
    /**
     * Create new instances of OrganizationInterface.
     *
     * @param OrganizationId $id
     * @param $name
     *
     * @return OrganizationInterface
     */
    public function make(OrganizationId $id, $name);
}
