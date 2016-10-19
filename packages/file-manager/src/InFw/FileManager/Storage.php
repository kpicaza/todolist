<?php

/**
 * This file is part of InFw\FileManager package.
 */

namespace InFw\FileManager;

use InFw\File\File;

/**
 * Interface Storage.
 */
interface Storage
{
    /**
     * Save file in storage.
     *
     * @param File $file
     *
     * @return bool
     */
    public function save(File $file);
}
