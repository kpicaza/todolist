<?php

/**
 * This file is part of InFw\FileManager package.
 */

namespace InFw\FileManager;

use InFw\File\File;

/**
 * Class BasicStorage.
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
    private $subFolder;

    /**
     * BasicStorage constructor.
     *
     * @param string $rootFolder
     */
    public function __construct($rootFolder)
    {
        if (false === is_dir($rootFolder)) {
            throw new \InvalidArgumentException(
                'Given folder ' . $rootFolder . ' does not exist.'
            );
        }

        $this->root = $rootFolder;
    }

    /**
     * Add sub-path to root.
     *
     * @param string $subFolder
     */
    public function addSubFolder($subFolder = '')
    {
        $path = $this->root . $this->subFolder;

        if (false === is_dir($path)) {
            throw new \InvalidArgumentException(
                'Given folder ' . $path . ' does not exist.'
            );
        }

        $this->subFolder = $subFolder;
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
        if (false === file_exists($file->getTmpName())
        ) {
            throw new \InvalidArgumentException(
                'Cannot upload file to given folder.'
            );
        }

        file_put_contents(
            $this->root . $this->subFolder . $file->getName(),
            $file->getTmpName()
        );

        return $file;
    }

    /**
     * Get Folder.
     *
     * @return string
     */
    public function getFolder()
    {
        return $this->root . $this->subFolder;
    }
}
