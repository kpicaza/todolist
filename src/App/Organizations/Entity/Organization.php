<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;

/**
 * Class Organization
 * @package App\Organizations\Entity
 */
class Organization implements OrganizationInterface
{
    /**
     * Organization unique identifier.
     *
     * @var OrganizationId
     */
    private $id;

    /**
     * Organization Name.
     *
     * @var string
     */
    private $name;

    /**
     * Organization constructor.
     *
     * @param OrganizationId $id
     * @param $name
     */
    public function __construct(OrganizationId $id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Get Organization id.
     *
     * @return string
     */
    public function id()
    {
        return (string) $this->id;
    }

    /**
     * Get Organization name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
