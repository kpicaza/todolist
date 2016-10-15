<?php

/**
 * This file is part of TodoList\Organizations package.
 */

namespace App\Organizations\Entity;

/**
 * Class Organization.
 */
class Organization implements OrganizationInterface, \JsonSerializable
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
     * Task created datetime.
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Task updated datetime.
     *
     * @return \DateTimeInterface
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *  Set created at.
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Set updated at.
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
        ];
    }
}
