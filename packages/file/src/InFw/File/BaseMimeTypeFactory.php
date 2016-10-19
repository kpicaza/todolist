<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Class BaseMimeTypeFactory.
 */
class BaseMimeTypeFactory implements MimeTypeFactory
{
    /**
     * Allowed mime types.
     *
     * @var array
     */
    private $validMimeTypes;

    /**
     * BaseMimeTypeFactory constructor
     * .
     *
     * @param array $validMimeTypes
     */
    public function __construct(array $validMimeTypes)
    {
        $this->validMimeTypes = $validMimeTypes;
    }

    /**
     * Create new instances of MimeType object.
     *
     * @param string $mimeType
     *
     * @return MimeType
     */
    public function make($mimeType)
    {
        return new BaseMimeType(
            $mimeType,
            $this->validMimeTypes
        );
    }
}
