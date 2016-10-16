<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

use InFw\Size\Size;

/**
 * Class AbstractFile.
 */
abstract class AbstractFile implements File
{
    /**
     * File name.
     *
     * @var string
     */
    private $name;

    /**
     * File mime type.
     *
     * @var MimeType
     */
    private $mimeType;

    /**
     * File size.
     *
     * @var Size
     */
    private $size;

    /**
     * File tmp path name.
     *
     * @var string
     */
    private $tmpName;

    /**
     * AbstractFile constructor.
     *
     * @param string   $name
     * @param MimeType $mimeType
     * @param Size     $size
     * @param string   $tmpName
     */
    public function __construct($name, MimeType $mimeType, Size $size, $tmpName)
    {
        $this->name = $name;
        $this->mimeType = $mimeType;
        $this->size = $size;

        if (false === file_exists($tmpName)) {
            throw new \InvalidArgumentException(
                'File '.$tmpName.' does not exists.'
            );
        }

        $this->tmpName = $tmpName;
    }

    /**
     * Obtain File name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Obtain File mime type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType->get();
    }

    /**
     * Obtain File size in kb.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size->get();
    }

    /**
     * Obtain File tmp path name.
     *
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
            'mimeType' => $this->mimeType->get(),
            'size' => $this->size->get(),
        ];
    }
}
