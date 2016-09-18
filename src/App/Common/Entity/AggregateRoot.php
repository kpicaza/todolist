<?php

/**
 * This file is part of TodoList\Common package.
 */

namespace App\Common\Entity;

/**
 * Class AggregateRoot
 *
 * @package App\Common\Entity
 */
abstract class AggregateRoot implements \JsonSerializable
{

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

}