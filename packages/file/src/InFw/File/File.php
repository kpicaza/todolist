<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Interface File.
 */
interface File extends \JsonSerializable
{
    /**
     * @return mixed
     */
    public function getSize();

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getTmpName();

    /**
     * @return mixed
     */
    public function getMimeType();
}
