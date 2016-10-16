<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

use InFw\Range\BaseRange;
use InFw\Range\Range;

/**
 * Class BaseSizeFactory
 */
interface SizeFactory
{
    /**
     * Create instances of Size object.
     *
     * @param int $size
     *
     * @return Size
     */
    public function make($size);
}
