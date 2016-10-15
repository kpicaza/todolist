<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Class AbstractFile.
 */
abstract class AbstractFile implements File
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var Size
     */
    private $size;

    /**
     * @var string
     */
    private $tmpName;

    /**
     * GenericFile constructor.
     *
     * @param string $name
     * @param string $mimeType
     * @param Size   $size
     * @param string $tmpName
     */
    public function __construct($name, $mimeType, Size $size, $tmpName)
    {
        $this->name = $name;
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->tmpName = $tmpName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size->get();
    }

    /**
     * @return string
     */
    public function getTmpName()
    {
        return $this->tmpName;
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
            'name' => $this->name,
            'mimeType' => $this->mimeType,
            'size' => $this->size->get(),
        ];
    }
}
