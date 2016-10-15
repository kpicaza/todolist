<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

use InFw\Range\Range;

/**
 * Class Size.
 */
interface Size
{
    /**
     * @return int
     */
    public function get();

    /**
     * @return Range
     */
    public function getRange();
}
