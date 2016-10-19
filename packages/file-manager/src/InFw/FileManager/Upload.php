<?php

/**
 * This file is part of InFw\FileManager package.
 */

namespace InFw\FileManager;

use InFw\File\File;

/**
 * Interface Upload.
 */
interface Upload
{
    /**
     * Save file at file system.
     *
     * @param string $path
     * @param string $name
     *
     * @return File
     */
    public function sendToStorage($path, $name);
}
