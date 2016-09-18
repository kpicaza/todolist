<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;
use App\Common\Entity\AggregateRoot;

/**
 * Class Organization
 * @package App\Organizations\Entity
 */
class Organization extends AggregateRoot implements OrganizationInterface
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
     * Created at.
     *
     * @var \DateTimeInterface
     */
    private $createdAt;

    /**
     * Updated at.
     *
     * @var \DateTimeInterface
     */
    private $updatedAt;

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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name
        ];
    }
}
