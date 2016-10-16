<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\Size;

use InFw\Range\Range;

/**
 * Class Size.
 */
interface Size
{
    /**
     * Get size.
     *
     * @return int
     */
    public function get();

    /**
     * Get size range.
     *
     * @return Range
     */
    public function getRange();
}
