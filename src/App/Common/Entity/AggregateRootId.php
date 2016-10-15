<?php

/**
 * This file is part of TodoList\Common package.
 */

namespace App\Common\Entity;

/**
 * Class AggregateRootId.
 */
abstract class AggregateRootId
{
    /**
     * Id.
     *
     * @var string
     */
    private $id;

    /**
     * Id constructor.
     *
     * @param $uuid
     */
    public function __construct($uuid)
    {
        $this->id = $uuid;
    }

    /**
     * Get Id from Uuid.
     *
     * @param string $id
     *
     * @return static
     */
    public static function fromString($id)
    {
        return new static($id);
    }

    /**
     * Get Id as string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->id;
    }
}
