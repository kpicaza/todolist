<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\Size;

use InFw\Range\Range;

/**
 * Class Size.
 */
class BaseSize implements Size
{
    /**
     * Size.
     *
     * @var int
     */
    private $size;

    /**
     * Size range.
     *
     * @var Range
     */
    private $range;

    /**
     * Size constructor.
     *
     * @param $size
     * @param Range $range
     */
    public function __construct($size, Range $range)
    {
        $this->range = $range;

        if (
            false === is_int($size)
            || $size < $this->range->getMin()
            || $size > $this->range->getMax()
        ) {
            throw new \InvalidArgumentException(sprintf(
                'Size must be between %s and %s.',
                $this->range->getMin(),
                $this->range->getMax()
            ));
        }

        $this->size = $size;
    }

    /**
     * Get size as a number.
     *
     * @return int
     */
    public function get()
    {
        return $this->size;
    }

    /**
     * Get size range.
     *
     * @return Range
     */
    public function getRange()
    {
        return $this->range;
    }
}
