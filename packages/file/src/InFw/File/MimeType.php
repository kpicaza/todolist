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
     * Check if file mime is in valid mime types.
     *
     * @param $filePath
     * @param array $validMimeTypes
     *
     * @return bool
     */
    public static function isValid($filePath, array $validMimeTypes);

    /**
     * Get mime type.
     *
     * @return string
     */
    public function get();
}
