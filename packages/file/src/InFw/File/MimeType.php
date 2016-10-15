<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Interface MimeType.
 */
interface MimeType
{
    /**
     * @param $mimeType
     *
     * @return bool
     */
    static public function isValid($mimeType, array $validMimeTypes);

    /**
     * @return string
     */
    public function get();
}
