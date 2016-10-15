<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 15/10/16
 * Time: 23:34
 */

namespace InFw\File;

/**
 * Class BaseMimeType
 * @package InFw\File
 */
class BaseMimeType implements MimeType
{
    /**
     * @var string
     */
    protected $validMimeTypes;

    /**
     * @var string
     */
    protected $mime;

    /**
     * BaseMimeType constructor.
     *
     * @param $mimeType
     * @param $group
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
                'Mime type is not one of valid mime types.'
            );
        }

        $this->mime = $mimeType;
    }

    /**
     * @param $filePath
     * @param array $validMimeTypes
     *
     * @return bool
     */
    static public function isValid($filePath, array $validMimeTypes)
    {
        return true === in_array(
            mime_content_type($filePath),
            $validMimeTypes,
            true
        );
    }

    /**
     * @return string
     */
    public function get()
    {
        return $this->mime;
    }
}