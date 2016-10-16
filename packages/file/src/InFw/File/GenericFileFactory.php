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
     * Size Factory.
     *
     * @var SizeFactory
     */
    private $size;

    /**
     * Valid mime types.
     *
     * @var array
     */
    private $validMimeTypes;

    /**
     * GenericFileFactory constructor.
     *
     * @param SizeFactory $sizeFactory
     * @param array $validMimeTypes
     */
    public function __construct(SizeFactory $sizeFactory, array $validMimeTypes)
    {
        $this->size = $sizeFactory;
        $this->validMimeTypes = $validMimeTypes;
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
            new BaseMimeType($mimeType, $this->validMimeTypes),
            $this->size->make($size),
            $filePath
        );
    }
}
