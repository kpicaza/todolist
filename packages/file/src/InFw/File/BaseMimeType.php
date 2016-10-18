<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Class BaseMimeType.
 */
class BaseMimeType implements MimeType
{
    /**
     * Contains valid mime types.
     *
     * @var array
     */
    protected $validMimeTypes;

    /**
     * Mime type.
     *
     * @var string
     */
    protected $mime;

    /**
     * BaseMimeType constructor.
     *
     * @param string $mimeType
     * @param array  $validMimeTypes
     */
    public function __construct($mimeType, array $validMimeTypes)
    {
        $validTypes = MimeTypes::ALL;

        if (
            0 >= count(
                array_filter($validMimeTypes, function ($mime) use ($validTypes) {
                    return true === in_array($mime, $validTypes, true);
                })
            )
        ) {
            throw new \InvalidArgumentException(
                'Valid mime type array have invalid types.'
            );
        }

        $this->validMimeTypes = $validMimeTypes;

        if (false === in_array($mimeType, $this->validMimeTypes, true)) {
            throw new \InvalidArgumentException(
                'Mime type is not one of valid mime types.' . $mimeType
            );
        }

        $this->mime = $mimeType;
    }

    /**
     * Check if file mime is in valid mime types.
     *
     * @param string $filePath
     * @param array  $validMimeTypes
     *
     * @return bool
     */
    public static function isValid($filePath, array $validMimeTypes)
    {
        return true === in_array(
            mime_content_type($filePath),
            $validMimeTypes,
            true
        );
    }

    /**
     * Get mime type.
     *
     * @return string
     */
    public function get()
    {
        return $this->mime;
    }
}
