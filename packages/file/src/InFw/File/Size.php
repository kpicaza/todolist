<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Class Size.
 */
class Size
{
    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $min;

    /**
     * @var int
     */
    private $max;

    /**
     * Size constructor.
     *
     * @param int $size
     * @param int $min
     * @param int $max
     */
    public function __construct($size, $min, $max)
    {
        if (
            3 !== count(array_filter([$size, $min, $max], function ($value) {
                return true === is_int($value);
            }))
        ) {
            throw new \InvalidArgumentException(
                'All parameters at Size object must be integers.'
            );
        }

        $this->min = $min;
        $this->max = $max;

        if ($size > $this->max || $size < $this->min) {
            throw new \InvalidArgumentException(sprintf(
                'Size must be between %s and %s.',
                $this->min,
                $this->max
            ));
        }

        $this->size = $size;
    }

    /**
     * @return int
     */
    public function get()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }
}
