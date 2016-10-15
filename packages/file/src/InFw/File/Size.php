<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;
use InFw\Range\Range;

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
     * @var Range
     */
    private $range;

    /**
     * Size constructor.
     *
     * @param int $size
     * @param int $min
     * @param int $max
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
     * @return int
     */
    public function get()
    {
        return $this->size;
    }

    /**
     * @return Range
     */
    public function getRange()
    {
        return $this->range;
    }
}
