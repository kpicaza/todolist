<?php

namespace InFw\Range;

interface Range
{
    /**
     * @return int
     */
    public function getMin();

    /**
     * @return int
     */
    public function getMax();
}
