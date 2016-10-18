<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

use InFw\Size\SizeFactory;

/**
 * Class GenericFileFactory.
 */
class GenericFileFactory implements FileFactory
{
    /**
     * Mime type Factory.
     *
     * @var MimeTypeFactory
     */
    private $mimeType;

    /**
     * Size Factory.
     *
     * @var SizeFactory
     */
    private $size;

    /**
     * GenericFileFactory constructor.
     *
     * @param MimeTypeFactory $mimeTypeFactory
     * @param SizeFactory     $sizeFactory
     */
    public function __construct(
        MimeTypeFactory $mimeTypeFactory,
        SizeFactory $sizeFactory
    ) {
        $this->mimeType = $mimeTypeFactory;
        $this->size = $sizeFactory;
    }

    /**
     * Make instances of GenericFile.
     *
     * @param string $name
     * @param string $filePath
     *
     * @return File
     */
    public function make($name, $filePath)
    {
        return new GenericFile(
            $name,
            $this->mimeType->make(
                mime_content_type($filePath)
            ),
            $this->size->make(
                filesize($filePath)
            ),
            $filePath
        );
    }
}
