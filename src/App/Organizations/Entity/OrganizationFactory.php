<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;
use Ramsey\Uuid\Uuid;

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
     * @param string $id
     * @param string $name
     *
     * @return OrganizationInterface
     */
    public function make($id, $name)
    {
        $id = new OrganizationId(null === $id ? Uuid::uuid4() : $id);

        return new Organization($id, $name);
    }
}
