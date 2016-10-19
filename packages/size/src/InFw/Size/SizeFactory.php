<?php

/**
 * This file is part of InFw\Size package.
 */

namespace InFw\Size;

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
