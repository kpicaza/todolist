<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Interface FileFactory.
 */
interface FileFactory
{
    /**
     * Make instances of GenericFile.
     *
     * @param string $name
     * @param string $mimeType
     * @param int    $size
     * @param string $filePath
     *
     * @return File
     */
    public function make($name, $mimeType, $size, $filePath);
}
