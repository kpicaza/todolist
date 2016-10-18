<?php

/**
 * This file is part of InFw\FileManager package.
 */

namespace InFw\FileManager;

use InFw\File\File;

/**
 * Class BasicStorage
 */
class BasicStorage implements Storage
{
    /**
     * Root folder for filesystem.
     *
     * @var string
     */
    private $root;

    /**
     * Path to storage from root.
     *
     * @var string
     */
    private $subPath;

    /**
     * BasicStorage constructor.
     *
     * @param string $rootFolder
     */
    public function __construct($rootFolder)
    {
        if (false === file_exists($rootFolder)) {
            throw new \InvalidArgumentException(
                'Given folder ' . $rootFolder . ' does not exist.'
            );
        }

        $this->root = $rootFolder;
    }

    /**
     * Add sub-path to root.
     *
     * @param string $subPath
     */
    public function addSubPath($subPath = '')
    {
        $path = $this->root . $this->subPath;

        if (false === file_exists($path)) {
            throw new \InvalidArgumentException(
                'Given folder ' . $path . ' does not exist.'
            );
        }

        $this->subPath = $subPath;
    }

    /**
     * Persist file in a filesystem.
     *
     * @param File $file
     *
     * @return File
     */
    public function save(File $file)
    {
        if (
            false === file_put_contents(
                $this->root . $this->subPath . $file->getName(),
                $file->getTmpName()
            )
        ) {
            throw new \RuntimeException(
                'Cannot upload file to given folder.'
            );
        }

        return $file;
    }
}
