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
     * Obtain File name.
     *
     * @return string
     */
    public function getName();

    /**
     * Obtain File mime type.
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Obtain File size in kb.
     *
     * @return int
     */
    public function getSize();

    /**
     * Obtain File tmp path name.
     *
     * @return string
     */
    public function getTmpName();
}
