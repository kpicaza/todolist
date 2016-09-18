<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;

/**
 * Class OrganizationFactory
 *
 * @package App\Organizations\Entity
 */
class OrganizationFactory implements OrganizationFactoryInterface
{
    /**
     * Create new instances of OrganizationInterface.
     *
     * @param OrganizationId $id
     * @param string $name
     *
     * @return OrganizationInterface
     */
    public function make(OrganizationId $id, $name)
    {
        return new Organization($id, $name);
    }
}
