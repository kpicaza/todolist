<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

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
    )
    {
        $this->mimeType = $mimeTypeFactory;
        $this->size = $sizeFactory;
    }

    /**
     * Make instances of GenericFile.
     *
     * @param string $name
     * @param string $mimeType
     * @param int    $size
     * @param string $filePath
     *
     * @return GenericFile
     */
    public function make($name, $mimeType, $size, $filePath)
    {
        return new GenericFile(
            $name,
            $this->mimeType->make($mimeType),
            $this->size->make($size),
            $filePath
        );
    }
}
