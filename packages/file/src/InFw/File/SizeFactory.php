<?php

/**
 * This file is part of InFw\File package.
 */

namespace InFw\File;

/**
 * Class BaseSizeFactory.
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
