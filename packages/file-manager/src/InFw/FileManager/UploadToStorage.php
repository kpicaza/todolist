<?php

/**
 * This file is part of InFw\FileManager package.
 */

namespace InFw\FileManager;

use InFw\File\File;
use InFw\File\FileFactory;

/**
 * Class UploadToStorage.
 */
class UploadToStorage implements Upload
{
    /**
     * File storage.
     *
     * @var Storage
     */
    private $storage;

    /**
     * File factory.
     *
     * @var FileFactory
     */
    private $factory;

    /**
     * UploadToStorage constructor.
     *
     * @param Storage     $storage
     * @param FileFactory $factory
     */
    public function __construct(Storage $storage, FileFactory $factory)
    {
        $this->storage = $storage;
        $this->factory = $factory;
    }

    /**
     * Send a file to storage.
     *
     * @param string $path
     * @param string $name
     *
     * @return File
     */
    public function sendToStorage($path, $name)
    {
        $file = $this->factory->make($name, $path);

        $this->storage->save($file);

        return $file;
    }
}
