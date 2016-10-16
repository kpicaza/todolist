<?php

/**
 * This file is part of InFw\Size package.
 */

namespace InFw\Size;

use InFw\Range\BaseRange;
use InFw\Range\Range;

/**
 * Class BaseSizeFactory.
 */
class BaseSizeFactory implements SizeFactory
{
    /**
     * File size range.
     *
     * @var Range
     */
    private $range;

    /**
     * BaseSizeFactory constructor.
     *
     * @param int $minSize
     * @param int $maxSize
     */
    public function __construct($minSize, $maxSize)
    {
        $this->range = new BaseRange(
            $minSize,
            $maxSize
        );
    }

    /**
     * Create instances of Size object.
     *
     * @param int $size
     * @param int $minSize
     * @param int $maxSize
     *
     * @return Size
     */
    public function make($size)
    {
        return new BaseSize(
            $size,
            $this->range
        );
    }
}
